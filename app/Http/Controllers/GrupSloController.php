<?php

namespace App\Http\Controllers;

use App\GrupSlo;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GrupSloController extends Controller
{
    private $grupSlo;
    public function __construct(GrupSlo $grupSlo)
    {
        $this->middleware('auth');
        $this->grupSlo = $grupSlo;
        view()->share(['title' => 'Grup Slo']);
    }

    public function index()
    {
        return view('grup_slo.index');
    }

    public function search(Request $request)
    {
        $grupSlo = $this->grupSlo;
        if ($request->has('nama') && $request->input('nama') != '')
            $grupSlo = $grupSlo->where('nama', 'like', '%'. $request->input('nama') .'%');
        if ($request->has('ajax')) return $grupSlo->get();
        $grupSlo = $request->has('paginate') ?
            $grupSlo->paginate($request->input('paginate')) :
            $grupSlo->get();
        return view('grup_slo._table', compact('grupSlo'));
    }

    public function info(Request $request)
    {
        $grupSlo = $request->has('id') ? $this->grupSlo->find($request->input('id')) : [];
        return view('grup_slo.info', compact('grupSlo'));
    }

    public function save(Request $request)
    {
        if (!$request->has('id'))
            $grupSlo = $this->grupSlo->create($request->all());
        else {
            $grupSlo = $this->grupSlo->find($request->input('id'));
            $grupSlo->update($request->all());
        }
        if ($request->has('ajax')) return $grupSlo;
        return redirect()->route('grup_slo')
            ->with('success', 'Grup Slo berhasil disimpan');
    }

    public function delete(Request $request)
    {
        if (!$request->has('id')) return abort(404);
        $grupSlo = $this->grupSlo->find($request->input('id'));
        $grupSlo->delete();
        if ($request->has('ajax')) return $grupSlo;
        return redirect()->route('grup_slo')
            ->with('success', 'Grup Slo berhasil dihapus');
    }
}
