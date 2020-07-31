<?php

namespace App\Http\Controllers;

use App\ItemKelengkapan;
use Illuminate\Http\Request;

class ItemKelengkapanController extends Controller
{
    private $itemKelengkapan;
    public function __construct(ItemKelengkapan $itemKelengkapan)
    {
        $this->middleware('auth');
        $this->itemKelengkapan = $itemKelengkapan;
        view()->share(['title' => 'Item Kelengkapan']);
    }

    public function index()
    {
        return view('item_kelengkapan.index');
    }

    public function search(Request $request)
    {
        $itemKelengkapan = $this->itemKelengkapan->whereNull('parent_id')->orderBy('no_urut', 'asc');
        if ($request->has('nama') && $request->input('nama') != '')
            $itemKelengkapan = $itemKelengkapan->where('nama', 'like', '%'. $request->input('nama') .'%');
        if ($request->has('ajax')) return $itemKelengkapan->get();
        $itemKelengkapan = $request->has('paginate') ?
            $itemKelengkapan->paginate($request->input('paginate')) :
            $itemKelengkapan->get();
        return view('item_kelengkapan._table', compact('itemKelengkapan'));
    }

    public function info(Request $request)
    {
        $itemKelengkapan = $request->has('id') ? $this->itemKelengkapan->find($request->input('id')) : [];
        $parent = $request->has('parent_id') ? $this->itemKelengkapan->find($request->input('parent_id')) : null;
        return view('item_kelengkapan.info', compact('itemKelengkapan', 'parent'));
    }

    public function save(Request $request)
    {
        if (!$request->has('id'))
            $itemKelengkapan = $this->itemKelengkapan->create($request->all());
        else {
            $itemKelengkapan = $this->itemKelengkapan->find($request->input('id'));
            $itemKelengkapan->update($request->all());
        }
        if ($request->has('ajax')) return $itemKelengkapan;
        return redirect()->route('item_kelengkapan')
            ->with('success', 'Item Kelengkapan berhasil disimpan');
    }

    public function delete(Request $request)
    {
        if (!$request->has('id')) return abort(404);
        $itemKelengkapan = $this->itemKelengkapan->find($request->input('id'));
        $itemKelengkapan->delete();
        if ($request->has('ajax')) return $itemKelengkapan;
        return redirect()->route('item_kelengkapan')
            ->with('success', 'Item Kelengkapan berhasil dihapus');
    }
}
