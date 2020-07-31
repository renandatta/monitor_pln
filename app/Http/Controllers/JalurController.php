<?php

namespace App\Http\Controllers;

use App\Jalur;
use Illuminate\Http\Request;

class JalurController extends Controller
{
    private $jalur;
    public function __construct(Jalur $jalur)
    {
        $this->middleware('auth');
        $this->jalur = $jalur;
        view()->share(['title' => 'Jalur']);
    }

    public function index()
    {
        return view('jalur.index');
    }

    public function search(Request $request)
    {
        $jalur = $this->jalur;
        if ($request->has('nama') && $request->input('nama') != '')
            $jalur = $jalur->where('nama', 'like', '%'. $request->input('nama') .'%');
        if ($request->has('ajax')) return $jalur->get();
        $jalur = $request->has('paginate') ?
            $jalur->paginate($request->input('paginate')) :
            $jalur->get();
        return view('jalur._table', compact('jalur'));
    }

    public function info(Request $request)
    {
        $jalur = $request->has('id') ? $this->jalur->find($request->input('id')) : [];
        return view('jalur.info', compact('jalur'));
    }

    public function save(Request $request)
    {
        if (!$request->has('id'))
            $jalur = $this->jalur->create($request->all());
        else {
            $jalur = $this->jalur->find($request->input('id'));
            $jalur->update($request->all());
        }
        if ($request->has('ajax')) return $jalur;
        return redirect()->route('jalur')
            ->with('success', 'Jalur berhasil disimpan');
    }

    public function delete(Request $request)
    {
        if (!$request->has('id')) return abort(404);
        $jalur = $this->jalur->find($request->input('id'));
        $jalur->delete();
        if ($request->has('ajax')) return $jalur;
        return redirect()->route('jalur')
            ->with('success', 'Jalur berhasil dihapus');
    }
}
