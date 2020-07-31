<?php

namespace App\Http\Controllers;

use App\Instalasi;
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
    }

    public function index(Request $request)
    {
        $jalur = $this->jalurRepository->get_jalur();
        $jalurId = $request->has('jalur_id') ? $request->input('jalur_id') : null;
        return view('instalasi.index', compact('jalur', 'jalurId'));
    }

    public function search(Request $request)
    {
        $instalasi = $this->instalasi->orderBy('id', 'desc');
        if ($request->has('nama') && $request->input('nama') != '')
            $instalasi = $instalasi->where('nama', 'like', '%'. $request->input('nama') .'%');
        if ($request->has('jalur_id') && $request->input('jalur_id') != '')
            $instalasi = $instalasi->where('jalur_id', '=', $request->input('jalur_id'));
        if ($request->has('ajax')) return $instalasi->get();
        $instalasi = $request->has('paginate') ?
            $instalasi->paginate($request->input('paginate')) :
            $instalasi->get();
        $jalurId = $request->has('jalur_id') ? $request->input('jalur_id') : null;
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
