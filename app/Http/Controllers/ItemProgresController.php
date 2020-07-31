<?php

namespace App\Http\Controllers;

use App\ItemProgres;
use Illuminate\Http\Request;

class ItemProgresController extends Controller
{
    private $itemProgres;
    public function __construct(ItemProgres $itemProgres)
    {
        $this->middleware('auth');
        $this->itemProgres = $itemProgres;
        view()->share(['title' => 'Item Progres']);
    }

    public function index()
    {
        return view('item_progres.index');
    }

    public function search(Request $request)
    {
        $itemProgres = $this->itemProgres;
        if ($request->has('nama') && $request->input('nama') != '')
            $itemProgres = $itemProgres->where('nama', 'like', '%'. $request->input('nama') .'%');
        if ($request->has('ajax')) return $itemProgres->get();
        $itemProgres = $request->has('paginate') ?
            $itemProgres->paginate($request->input('paginate')) :
            $itemProgres->get();
        return view('item_progres._table', compact('itemProgres'));
    }

    public function info(Request $request)
    {
        $itemProgres = $request->has('id') ? $this->itemProgres->find($request->input('id')) : [];
        return view('item_progres.info', compact('itemProgres'));
    }

    public function save(Request $request)
    {
        if (!$request->has('id'))
            $itemProgres = $this->itemProgres->create($request->all());
        else {
            $itemProgres = $this->itemProgres->find($request->input('id'));
            $itemProgres->update($request->all());
        }
        if ($request->has('ajax')) return $itemProgres;
        return redirect()->route('item_progres')
            ->with('success', 'Item Progres berhasil disimpan');
    }

    public function delete(Request $request)
    {
        if (!$request->has('id')) return abort(404);
        $itemProgres = $this->itemProgres->find($request->input('id'));
        $itemProgres->delete();
        if ($request->has('ajax')) return $itemProgres;
        return redirect()->route('item_progres')
            ->with('success', 'Item Progres berhasil dihapus');
    }
}
