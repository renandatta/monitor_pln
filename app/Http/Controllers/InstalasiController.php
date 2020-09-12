<?php

namespace App\Http\Controllers;

use App\Instalasi;
use App\Kontraktor;
use App\Petugas;
use App\Repositories\JalurRepository;
use Illuminate\Http\Request;

class InstalasiController extends Controller
{
    private $instalasi, $jalurRepository;
    public function __construct(Instalasi $instalasi, JalurRepository $jalurRepository)
    {
        $this->middleware('auth');
        $this->instalasi = $instalasi;
        $this->jalurRepository = $jalurRepository;
        view()->share(['title' => 'Instalasi']);
        view()->share(['kontraktor' => Kontraktor::all()]);
        view()->share(['petugas' => Petugas::all()]);
    }

    public function index(Request $request)
    {
        $jalur = $this->jalurRepository->get_jalur();
        $jalurId = $request->has('jalur_id') ? $request->input('jalur_id') : null;
        return view('instalasi.index', compact('jalur', 'jalurId'));
    }

    public function search(Request $request)
    {
        $instalasi = $this->instalasi->orderBy('id', 'desc')
            ->with(['kontraktor', 'petugas', 'jalur']);

        if ($request->has('id') && $request->input('id') != '')
            $instalasi = $instalasi->where('id', '=', $request->input('id'));
        if ($request->has('nama') && $request->input('nama') != '')
            $instalasi = $instalasi->where('nama', 'like', '%'. $request->input('nama') .'%');
        if ($request->has('jalur_id') && $request->input('jalur_id') != '')
            $instalasi = $instalasi->where('jalur_id', '=', $request->input('jalur_id'));
        if ($request->has('ajax')) return $instalasi->get();
        $instalasi = $request->has('paginate') ?
            $instalasi->paginate($request->input('paginate')) :
            $instalasi->get();
        $jalurId = $request->has('jalur_id') ? $request->input('jalur_id') : null;
        if ($request->has('ajax')) return $instalasi;
        return view('instalasi._table', compact('instalasi', 'jalurId'));
    }

    public function info(Request $request)
    {
        $instalasi = $request->has('id') ? $this->instalasi->find($request->input('id')) : [];
        $jalur = $this->jalurRepository->get_jalur();
        $jalurId = $request->has('jalur_id') ? $request->input('jalur_id') : null;
        return view('instalasi.info', compact('instalasi', 'jalur', 'jalurId'));
    }

    public function save(Request $request)
    {
        $request->merge(['tanggal_surat_inspeksi' => unformat_date($request->input('tanggal_surat_inspeksi'))]);
        $request->merge(['tanggal_slb' => unformat_date($request->input('tanggal_slb'))]);
        $request->merge(['tanggal_energize' => unformat_date($request->input('tanggal_energize'))]);
        $request->merge(['tanggal_st1' => unformat_date($request->input('tanggal_st1'))]);
        $request->merge(['tanggal_st2' => unformat_date($request->input('tanggal_st2'))]);
        $request->merge(['tanggal_slo' => unformat_date($request->input('tanggal_slo'))]);
        $request->merge(['tanggal_stop' => unformat_date($request->input('tanggal_stop'))]);
        $request->merge(['tanggal_stap' => unformat_date($request->input('tanggal_stap'))]);
        $request->merge(['tanggal_stp' => unformat_date($request->input('tanggal_stp'))]);

        if (!$request->has('id'))
            $instalasi = $this->instalasi->create($request->all());
        else {
            $instalasi = $this->instalasi->find($request->input('id'));
            $instalasi->update($request->all());
        }
        if ($request->has('ajax')) return $instalasi;
        return redirect()->route('instalasi')
            ->with('success', 'Instalasi berhasil disimpan');
    }

    public function delete(Request $request)
    {
        if (!$request->has('id')) return abort(404);
        $instalasi = $this->instalasi->find($request->input('id'));
        $instalasi->delete();
        if ($request->has('ajax')) return $instalasi;
        return redirect()->route('instalasi')
            ->with('success', 'Instalasi berhasil dihapus');
    }
}
