<?php

namespace App\Http\Controllers;

use App\ItemKelengkapan;
use App\KelengkapanInstalasiDetail;
use App\Kontraktor;
use App\Petugas;
use App\Repositories\GrupSloRepository;
use App\Repositories\InstalasiRepository;
use App\Repositories\KelengkapanInstalasiRepository;
use Illuminate\Http\Request;
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
        $kelengkapan = $request->has('id') ?
            $this->kelengkapanInstalasiRepository->find($request->input('id')) : [];
        $listDokumen = [];
        if (!empty($kelengkapan)) {
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
        }
        return view('kelengkapan_instalasi.info', compact('kelengkapan', 'listDokumen'));
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
        }
        return redirect()->route('kelengkapan_instalasi.info', 'id=' . $field->kelengkapan_instalasi_id);
    }

    public function detail_verifikasi(Request $request)
    {
        if (!$request->has('id')) return abort(404);
        if (!$request->has('status')) return abort(404);
        KelengkapanInstalasiDetail::where('id', '=', $request->input('id'))
            ->update(['status' => $request->input('status')]);
    }
}
