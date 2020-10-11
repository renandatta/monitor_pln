<?php

namespace App\Http\Controllers;

use App\Instalasi;
use App\Jalur;
use App\KelengkapanInstalasi;
use App\ProgresInstalasi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dataProgresJalur = array();
        $dataPersentase = array();
        $jalur = Jalur::all();
        $totalJalur = 0;
        $total70 = 0;
        $total70L = 0;
        $total100 = 0;
        foreach ($jalur as $key => $value) {
            $progresJalur = ProgresInstalasi::join('instalasi', 'instalasi.id', '=', 'progres_instalasi.instalasi_id')
                ->join('jalur', 'jalur.id', '=', 'instalasi.jalur_id')
                ->where('jalur_id', '=', $value->id)
                ->groupBy('jalur_id')
                ->select('progres_jalur', 'jalur.nama')
                ->first();
            $jalur[$key]->progres = !empty($progresJalur) ? $progresJalur->progres_jalur : 0;
            if (!empty($progresJalur)) {
                $totalJalur += $progresJalur->progres_jalur;
                if ($progresJalur->progres_jalur >= 70 && $progresJalur->progres_jalur < 100)
                    $total70L += 1;
                if ($progresJalur->progres_jalur == 100)
                    $total100 += 1;
            }
            if (empty($progresJalur) || $progresJalur->progres_jalur < 70)
                $total70 += 1;

        }
        $slo = Instalasi::whereNotNull('no_slo')->count();
        $total = Instalasi::count();
        array_push($dataProgresJalur, [
            'nama' => 'Progres Jalur',
            'slo' => round($slo, 2),
            'belum' => round($total - $slo, 2)
        ]);
        array_push($dataPersentase, [
            'nama' => 'Kurang dari 70%',
            'nilai' => $total70
        ]);
        array_push($dataPersentase, [
            'nama' => 'Lebih dari 70%',
            'nilai' => $total70L
        ]);
        array_push($dataPersentase, [
            'nama' => 'Sudah Mencapai 100%',
            'nilai' => $total100
        ]);

        return view('home.index', compact('dataProgresJalur', 'dataPersentase', 'jalur'));
    }
}
