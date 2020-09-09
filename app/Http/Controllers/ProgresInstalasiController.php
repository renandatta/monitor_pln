<?php

namespace App\Http\Controllers;

use App\Instalasi;
use App\ProgresInstalasi;
use App\ProgresInstalasiDetail;
use App\Repositories\GrupSloRepository;
use App\Repositories\ItemProgresRepository;
use App\Repositories\JalurRepository;
use Illuminate\Http\Request;

class ProgresInstalasiController extends Controller
{
    private $progresInstalasi, $jalurRepository, $grupSloRepository, $itemProgresRepository, $instalasi, $progresInstalasiDetail;
    public function __construct(ProgresInstalasi $progresInstalasi,
                                JalurRepository $jalurRepository,
                                GrupSloRepository $grupSloRepository,
                                ItemProgresRepository $itemProgresRepository,
                                Instalasi $instalasi,
                                ProgresInstalasiDetail $progresInstalasiDetail)
    {
        $this->middleware('auth');
        $this->progresInstalasi = $progresInstalasi;
        $this->jalurRepository = $jalurRepository;
        $this->grupSloRepository = $grupSloRepository;
        $this->itemProgresRepository = $itemProgresRepository;
        $this->instalasi = $instalasi;
        $this->progresInstalasiDetail = $progresInstalasiDetail;
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
        $grupSloId = $request->input('grup_slo_id');
        $itemProgres = $this->itemProgresRepository->item_by_grup($grupSloId);

        $instalasi = $this->instalasi->where('jalur_id', '=', $request->input('jalur_id'))->get();

        $totalProgresJalur = 0;
        foreach ($instalasi as $key => $value) {
            $progres = $this->progresInstalasi->where('instalasi_id', '=', $value->id)
                ->where('grup_slo_id', '=', $grupSloId)
                ->first();
            $instalasi[$key]->progres = $progres;

            $detailProgres = array();
            if (!empty($progres)) {
                $totalProgres = 0;
                foreach ($itemProgres as $key2 => $value2) {
                    $detail = $this->progresInstalasiDetail->where('progres_instalasi_id', '=', $progres->id)
                        ->where('item_progres_id', '=', $value2->id)
                        ->first();
                    if (!empty($detail)) {
                        $totalProgres += $detail->progres;
                    }
                    array_push($detailProgres, $detail);
                }
            }
            $progres = 0;
            if (count($itemProgres) > 0) {
                $progres = round($totalProgres / count($itemProgres) * 100, 2);
                ProgresInstalasi::where('instalasi_id', '=', $value->id)
                    ->where('grup_slo_id', '=', $grupSloId)
                    ->update(['progres_bay' => $progres]);
            }

            $instalasi[$key]->progres = $progres;
            $instalasi[$key]->detail_progres = $detailProgres;
            $totalProgresJalur += $progres;
        }
        $totalJalur = round($totalProgresJalur / count($instalasi), 2);
        if (count($itemProgres) > 0) {
            ProgresInstalasi::join('instalasi', 'instalasi.id', '=', 'progres_instalasi.instalasi_id')
                ->where('jalur_id', '=', $request->input('jalur_id'))
                ->update(['progres_jalur' => $totalJalur]);
        }

        return view('progres_instalasi._table', compact('instalasi', 'itemProgres', 'totalJalur'));
    }

    public function info(Request $request)
    {
        $progresInstalasi = $request->has('id') ? $this->progresInstalasi->find($request->input('id')) : [];
        $grupSlo = $this->grupSloRepository->get_slo();
        return view('progres_instalasi.info', compact('progresInstalasi', 'grupSlo', 'grupSloId'));
    }

    public function save(Request $request)
    {
        if (!$request->has('instalasi_id')) return abort(404);
        if (!$request->has('grup_slo_id')) return abort(404);
        if (!$request->has('status')) return abort(404);

        $progres = $this->progresInstalasi->firstOrCreate([
            'instalasi_id' => $request->input('instalasi_id'),
            'grup_slo_id' => $request->input('grup_slo_id'),
        ]);
        $progres->status = $request->input('status');
        $progres->progres_jalur = 0;
        $progres->progres_bay = 0;
        $progres->save();

        return $progres;
    }

    public function detail_save(Request $request)
    {
        if (!$request->has('instalasi_id')) return abort(404);
        if (!$request->has('grup_slo_id')) return abort(404);
        if (!$request->has('status')) return abort(404);
        if (!$request->has('detail_id')) return abort(404);
        if (!$request->has('progres')) return abort(404);

        $progres = $this->progresInstalasi->firstOrCreate([
            'instalasi_id' => $request->input('instalasi_id'),
            'grup_slo_id' => $request->input('grup_slo_id'),
        ]);
        $progres->status = $request->input('status');
        $progres->progres_jalur = 0;
        $progres->progres_bay = 0;
        $progres->save();

        $detail = $this->progresInstalasiDetail->firstOrCreate([
            'progres_instalasi_id' => $progres->id,
            'item_progres_id' => $request->input('detail_id')
        ]);
        $detail->progres = $request->input('progres');
        $detail->save();

        return $progres;
    }
}
