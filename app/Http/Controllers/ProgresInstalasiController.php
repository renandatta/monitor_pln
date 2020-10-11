<?php

namespace App\Http\Controllers;

use App\ItemKelengkapan;
use App\KelengkapanInstalasiDetail;
use App\ProgresInstalasi;
use App\Repositories\GrupSloRepository;
use App\Repositories\KelengkapanInstalasiRepository;
use Illuminate\Http\Request;

class ProgresInstalasiController extends Controller
{
    private $grupSloRepository, $kelengkapanInstalasiRepository, $itemKelengkapan, $kelengkapanInstalasiDetail;
    public function __construct(GrupSloRepository $grupSloRepository,
                                KelengkapanInstalasiRepository $kelengkapanInstalasiRepository,
                                ItemKelengkapan $itemKelengkapan, KelengkapanInstalasiDetail $kelengkapanInstalasiDetail)
    {
        $this->middleware('auth');
        $this->kelengkapanInstalasiRepository = $kelengkapanInstalasiRepository;
        $this->grupSloRepository = $grupSloRepository;
        $this->itemKelengkapan = $itemKelengkapan;
        $this->kelengkapanInstalasiDetail = $kelengkapanInstalasiDetail;
        view()->share(['title' => 'Progres Instalasi']);
    }

    public function index()
    {
        $grupSlo = $this->grupSloRepository->get_slo();
        return view('progres_instalasi.index', compact( 'grupSlo'));
    }

    public function search(Request $request)
    {
        if (!$request->has('grup_slo_id')) return abort(404);
        $itemKelengkapan = $this->itemKelengkapan->whereNull('parent_id')
            ->where('grup_slo_id', '=', $request->input('grup_slo_id'))
            ->with(['sub_items'])
            ->orderBy('no_urut', 'asc')
            ->get();
        $kelengakapanInstalasi = $this->kelengkapanInstalasiRepository->search($request);
        $jalurId = '';
        foreach ($kelengakapanInstalasi as $key => $value) {
            $progres = $this->kelengkapanInstalasiRepository->progress($value->id);
            $kelengakapanInstalasi[$key] = $progres;

            // === hitung jumlah per jalur
            if ($jalurId != $value->instalasi->jalur_id) {
                $jalurRequest = new Request();
                $jalurRequest->merge(['jalur_id' => $value->instalasi->jalur_id]);
                $jumlahPerJalur = count($this->kelengkapanInstalasiRepository->search($jalurRequest));
                $jalurId = $value->instalasi->jalur_id;
            } else {
                $jumlahPerJalur = 0;
            }
            // ===
            $kelengakapanInstalasi[$key]->jumlah_per_jalur = $jumlahPerJalur;
        }
        return view('progres_instalasi._table', compact('kelengakapanInstalasi', 'itemKelengkapan'));
    }
}
