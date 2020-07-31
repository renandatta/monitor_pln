<?php

namespace App\Http\Controllers;

use App\ItemKelengkapan;
use App\Repositories\GrupSloRepository;
use Illuminate\Http\Request;

class ItemKelengkapanController extends Controller
{
    private $itemKelengkapan, $grupSloRepository;
    public function __construct(ItemKelengkapan $itemKelengkapan, GrupSloRepository $grupSloRepository)
    {
        $this->middleware('auth');
        $this->itemKelengkapan = $itemKelengkapan;
        $this->grupSloRepository = $grupSloRepository;
        view()->share(['title' => 'Item Kelengkapan']);
    }

    public function index(Request $request)
    {
        $grupSlo = $this->grupSloRepository->get_slo();
        $grupSloId = $request->has('grup_slo_id') ? $request->input('grup_slo_id') : null;
        return view('item_kelengkapan.index', compact('grupSlo', 'grupSloId'));
    }

    public function search(Request $request)
    {
        $itemKelengkapan = $this->itemKelengkapan->whereNull('parent_id')->orderBy('no_urut', 'asc');
        if ($request->has('nama') && $request->input('nama') != '')
            $itemKelengkapan = $itemKelengkapan->where('nama', 'like', '%'. $request->input('nama') .'%');
        if ($request->has('grup_slo_id') && $request->input('grup_slo_id') != '')
            $itemKelengkapan = $itemKelengkapan->where('grup_slo_id', '=', $request->input('grup_slo_id'));
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
        $grupSlo = $this->grupSloRepository->get_slo();
        $grupSloId = $request->has('grup_slo_id') ? $request->input('grup_slo_id') : null;
        $lastNumber = $this->getLastNumber($request->has('parent_id') ? $parent->id : null);
        return view('item_kelengkapan.info', compact('itemKelengkapan', 'parent', 'grupSlo', 'grupSloId', 'lastNumber'));
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
        return redirect()->route('item_kelengkapan', 'grup_slo_id=' . $itemKelengkapan->grup_slo_id)
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

    public function getLastNumber($parentId = null)
    {
        $last = $this->itemKelengkapan->orderBy('no_urut', 'desc');
        $last = ($parentId == null) ? $last->whereNull('parent_id') : $last->where('parent_id', '=', $parentId);
        $last = $last->first();

        $nomor = (!empty($last)) ? $last->no_urut : 0;
        return intval($nomor) + 1;
    }
}
