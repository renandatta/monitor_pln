<?php

namespace App\Http\Controllers;

use App\Instalasi;
use App\ProgresInstalasi;
use App\Repositories\GrupSloRepository;
use App\Repositories\ItemProgresRepository;
use App\Repositories\JalurRepository;
use Illuminate\Http\Request;

class ProgresInstalasiController extends Controller
{
    private $progresInstalasi, $jalurRepository, $grupSloRepository, $itemProgresRepository, $instalasi;
    public function __construct(ProgresInstalasi $progresInstalasi,
                                JalurRepository $jalurRepository,
                                GrupSloRepository $grupSloRepository,
                                ItemProgresRepository $itemProgresRepository,
                                Instalasi $instalasi)
    {
        $this->middleware('auth');
        $this->progresInstalasi = $progresInstalasi;
        $this->jalurRepository = $jalurRepository;
        $this->grupSloRepository = $grupSloRepository;
        $this->itemProgresRepository = $itemProgresRepository;
        $this->instalasi = $instalasi;
        view()->share(['title' => 'Progres Instalasi']);
    }

    public function index(Request $request)
    {
        $jalur = $this->jalurRepository->get_jalur();
        $grupSlo = $this->grupSloRepository->get_slo();
        $grupSloId = $request->input('grup_slo_id') ?? $grupSlo[0]->id;
        return view('progres_instalasi.index', compact( 'jalur', 'grupSlo', 'grupSloId'));
    }

    public function search(Request $request)
    {
        if (!$request->has('grup_slo_id')) return abort(404);
        if (!$request->has('jalur_id')) return abort(404);
        $grupSloId = $request->has('grup_slo_id');
        $itemProgres = $this->itemProgresRepository->item_by_grup($grupSloId);

        $instalasi = $this->instalasi->where('jalur_id', '=', $request->input('jalur_id'))->get();

        return view('progres_instalasi._table', compact('instalasi', 'itemProgres'));
    }

    public function info(Request $request)
    {
        $progresInstalasi = $request->has('id') ? $this->progresInstalasi->find($request->input('id')) : [];
        $grupSlo = $this->grupSloRepository->get_slo();
        return view('progres_instalasi.info', compact('progresInstalasi', 'grupSlo', 'grupSloId'));
    }

    public function save(Request $request)
    {
        if (!$request->has('id'))
            $progresInstalasi = $this->progresInstalasi->create($request->all());
        else {
            $progresInstalasi = $this->progresInstalasi->find($request->input('id'));
            $progresInstalasi->update($request->all());
        }
        if ($request->has('ajax')) return $progresInstalasi;
        return redirect()->route('progres_instalasi', 'grup_slo_id=' . $progresInstalasi->grup_slo_id)
            ->with('success', 'Progres Instalasi berhasil disimpan');
    }

    public function delete(Request $request)
    {
        if (!$request->has('id')) return abort(404);
        $progresInstalasi = $this->progresInstalasi->find($request->input('id'));
        $progresInstalasi->delete();
        if ($request->has('ajax')) return $progresInstalasi;
        return redirect()->route('progres_instalasi', 'grup_slo_id=' . $progresInstalasi->grup_slo_id)
            ->with('success', 'Progres Instalasi berhasil dihapus');
    }
}
