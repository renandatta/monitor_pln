<?php

namespace App\Http\Controllers;

use App\ItemProgres;
use App\Repositories\GrupSloRepository;
use Illuminate\Http\Request;

class ItemProgresController extends Controller
{
    private $itemProgres, $grupSloRepository;
    public function __construct(ItemProgres $itemProgres, GrupSloRepository $grupSloRepository)
    {
        $this->middleware('auth');
        $this->itemProgres = $itemProgres;
        $this->grupSloRepository = $grupSloRepository;
        view()->share(['title' => 'Item Progres']);
    }

    public function index(Request $request)
    {
        $grupSlo = $this->grupSloRepository->get_slo();
        $grupSloId = $request->has('grup_slo_id') ? $request->input('grup_slo_id') : null;
        return view('item_progres.index', compact('grupSlo', 'grupSloId'));
    }

    public function search(Request $request)
    {
        $itemProgres = $this->itemProgres;
        if ($request->has('nama') && $request->input('nama') != '')
            $itemProgres = $itemProgres->where('nama', 'like', '%'. $request->input('nama') .'%');
        if ($request->has('grup_slo_id') && $request->input('grup_slo_id') != '')
            $itemProgres = $itemProgres->where('grup_slo_id', '=', $request->input('grup_slo_id'));
        if ($request->has('ajax')) return $itemProgres->get();
        $itemProgres = $request->has('paginate') ?
            $itemProgres->paginate($request->input('paginate')) :
            $itemProgres->get();
        $grupSloId = $request->has('grup_slo_id') ? $request->input('grup_slo_id') : null;
        return view('item_progres._table', compact('itemProgres', 'grupSloId'));
    }

    public function info(Request $request)
    {
        $itemProgres = $request->has('id') ? $this->itemProgres->find($request->input('id')) : [];
        $grupSlo = $this->grupSloRepository->get_slo();
        $grupSloId = $request->has('grup_slo_id') ? $request->input('grup_slo_id') : null;
        return view('item_progres.info', compact('itemProgres', 'grupSlo', 'grupSloId'));
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
        return redirect()->route('item_progres', 'grup_slo_id=' . $itemProgres->grup_slo_id)
            ->with('success', 'Item Progres berhasil disimpan');
    }

    public function delete(Request $request)
    {
        if (!$request->has('id')) return abort(404);
        $itemProgres = $this->itemProgres->find($request->input('id'));
        $itemProgres->delete();
        if ($request->has('ajax')) return $itemProgres;
        return redirect()->route('item_progres', 'grup_slo_id=' . $itemProgres->grup_slo_id)
            ->with('success', 'Item Progres berhasil dihapus');
    }
}
