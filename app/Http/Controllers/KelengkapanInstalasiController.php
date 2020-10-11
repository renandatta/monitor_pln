<?php

namespace App\Http\Controllers;

use App\ItemKelengkapan;
use App\KelengkapanInstalasiDetail;
use App\Kontraktor;
use App\LogKelengkapan;
use App\Petugas;
use App\Repositories\GrupSloRepository;
use App\Repositories\InstalasiRepository;
use App\Repositories\KelengkapanInstalasiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KelengkapanInstalasiController extends Controller
{
    protected $kelengkapanInstalasiRepository;
    public function __construct(InstalasiRepository $instalasiRepository,
                                GrupSloRepository $grupSloRepository,
                                Kontraktor $kontraktor, Petugas $petugas,
                                KelengkapanInstalasiRepository $kelengkapanInstalasiRepository)
    {
        $this->middleware('auth');
        $this->kelengkapanInstalasiRepository = $kelengkapanInstalasiRepository;
        view()->share(['title' => 'Kelengkapan Instalasi']);
        view()->share(['instalasi' => $instalasiRepository->get_instalasi()]);
        view()->share(['grupSlo' => $grupSloRepository->get_slo()]);
        view()->share(['kontraktor' => $kontraktor->all()]);
        view()->share(['petugas' => $petugas->all()]);
    }

    public function index()
    {
        return view('kelengkapan_instalasi.index');
    }

    public function info(Request $request)
    {
        $request->merge(['ajax' => 1]);
        $kelengkapan = $request->has('id') ?
            $this->kelengkapanInstalasiRepository->find($request->input('id')) : [];
        $listDokumen = [];
        if (!empty($kelengkapan)) {
            $listDokumen = $this->list_dokumen($request);
        }
        return view('kelengkapan_instalasi.info', compact('kelengkapan', 'listDokumen'));
    }

    public function list_dokumen(Request $request)
    {
        if (!$request->has('id')) return abort(404);
        $kelengkapanId = $request->input('id');
        $kelengkapan = $this->kelengkapanInstalasiRepository->find($kelengkapanId);
        $listDokumen = ItemKelengkapan::whereNull('parent_id')
            ->orderBy('no_urut', 'asc')
            ->where('grup_slo_id', '=', $kelengkapan->grup_slo_id)
            ->get();
        foreach ($listDokumen as $key => $value) {
            foreach ($value->sub_items as $key2 => $value2) {
                $listDokumen[$key]->sub_items[$key2]->upload = KelengkapanInstalasiDetail::where('kelengkapan_instalasi_id', '=', $kelengkapan->id)
                    ->where('item_kelengkapan_id', '=', $value2->id)->first();
            }
            $listDokumen[$key]->upload = KelengkapanInstalasiDetail::where('kelengkapan_instalasi_id', '=', $kelengkapan->id)
                ->where('item_kelengkapan_id', '=', $value->id)->first();
        }
        if ($request->has('ajax')) return $listDokumen;
        return view('kelengkapan_instalasi._list_dokumen', compact('listDokumen'));
    }

    public function riwayat_dokumen(Request $request)
    {
        $riwayat = LogKelengkapan::where('kelengkapan_instalasi_id', $request->input('id'))
            ->orderBy('tanggal', 'asc')
            ->orderBy('id', 'asc')
            ->with(['user'])->get();
        return view('kelengkapan_instalasi._riwayat_dokumen', compact('riwayat'));
    }

    public function search(Request $request)
    {
        $kelengkapan = $this->kelengkapanInstalasiRepository->search($request);
        if ($request->has('ajax')) return $kelengkapan;
        return view('kelengkapan_instalasi._table', compact('kelengkapan'));
    }

    public function save(Request $request)
    {
        $kelengkapan = $this->kelengkapanInstalasiRepository->save($request);
        if ($request->has('ajax')) return $kelengkapan;
        return redirect()->route('kelengkapan_instalasi.info', 'id=' . $kelengkapan->id);
    }

    public function delete(Request $request)
    {
        if (!$request->has('id')) return abort(404);
        $kelengkapan = $this->kelengkapanInstalasiRepository->delete($request);
        if ($request->has('ajax')) return $kelengkapan;
        return redirect()->route('kelengkapan_instalasi');
    }

    public function detail_save(Request $request)
    {
        if (!$request->has('kelengkapan_instalasi_id')) return abort(404);
        if (!$request->has('file')) return abort(404);
        $field = KelengkapanInstalasiDetail::firstOrCreate([
            'kelengkapan_instalasi_id' => $request->input('kelengkapan_instalasi_id'),
            'item_kelengkapan_id' => $request->input('item_kelengkapan_id'),
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = Str::random(6).'_' . $field->id . '.'. $request->file('file')->extension();
            $path = Storage::putFileAs('kelengkapan', $file, $filename);
            $field->konten = $path;
            $field->status = 'Pending';
            $field->save();

            LogKelengkapan::create([
                'user_id' => Auth::user()->id,
                'kelengkapan_instalasi_id' => $field->kelengkapan_instalasi_id,
                'keterangan' => 'Upload dokumen kelengkapan <b>' . ItemKelengkapan::find($field->item_kelengkapan_id)->nama . '</b>'
            ]);
        }
        return redirect()->route('kelengkapan_instalasi.info', 'id=' . $field->kelengkapan_instalasi_id);
    }

    public function detail_verifikasi(Request $request)
    {
        if (!$request->has('id')) return abort(404);
        if (!$request->has('status')) return abort(404);
        KelengkapanInstalasiDetail::where('id', '=', $request->input('id'))
            ->update([
                'status' => $request->input('status'),
                'pesan_tolak' => $request->input('pesan')
            ]);
        $detail = KelengkapanInstalasiDetail::find($request->input('id'));

        $alasan = $request->input('pesan') != '' ? ' dengan alasan : <b>' . $request->input('pesan') . '</b>' : '';

        LogKelengkapan::create([
            'user_id' => Auth::user()->id,
            'kelengkapan_instalasi_id' => $detail->kelengkapan_instalasi_id,
            'keterangan' => 'Verifikasi <b>' . $request->input('status') . '</b> dokumen ' . ItemKelengkapan::find($detail->item_kelengkapan_id)->nama . $alasan
        ]);

        if ($request->input('status') == 'Terima')
            $this->kelengkapanInstalasiRepository->progress($detail->kelengkapan_instalasi_id);
    }

    public function save_riwayat(Request $request)
    {
        if (!$request->has('id') || !$request->has('keterangan')) return abort(404);
        $path = '';
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = Str::random(16) . '.' . $request->file('file')->extension();
            $path = Storage::putFileAs('riwayat', $file, $filename);
        }
        LogKelengkapan::create([
            'user_id' => Auth::user()->id,
            'kelengkapan_instalasi_id' => $request->input('id'),
            'keterangan' => $request->input('keterangan'),
            'tanggal' => unformat_date($request->input('tanggal')),
            'file' => $path
        ]);
        return redirect()->route('kelengkapan_instalasi')
            ->with('riwayat_id', $request->input('id'));
    }

    public function delete_riwayat(Request $request)
    {
        if (!$request->has('id')) return abort(404);
        LogKelengkapan::find($request->input('id'))->delete();
        return redirect()->route('kelengkapan_instalasi')
            ->with('riwayat_id', $request->input('id'));
    }
}
