<?php

namespace App\Http\Controllers;

use App\Kontraktor;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KontraktorController extends Controller
{
    private $kontraktor, $userRepository;
    public function __construct(Kontraktor $kontraktor, UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->kontraktor = $kontraktor;
        $this->userRepository = $userRepository;
        view()->share(['title' => 'Kontraktor']);
    }

    public function index()
    {
        return view('kontraktor.index');
    }

    public function search(Request $request)
    {
        $kontraktor = $this->kontraktor;
        if ($request->has('nama') && $request->input('nama') != '')
            $kontraktor = $kontraktor->where('nama', 'like', '%'. $request->input('nama') .'%');
        if ($request->has('ajax')) return $kontraktor->get();
        $kontraktor = $request->has('paginate') ?
            $kontraktor->paginate($request->input('paginate')) :
            $kontraktor->get();
        return view('kontraktor._table', compact('kontraktor'));
    }

    public function info(Request $request)
    {
        $kontraktor = $request->has('id') ? $this->kontraktor->find($request->input('id')) : [];
        return view('kontraktor.info', compact('kontraktor'));
    }

    public function save(Request $request)
    {
        if ($request->has('password') && $request->input('password') != '')
            $request->merge(['password' => Hash::make($request->input('password'))]);
        else
            $request->request->remove('password');

        $request->merge(['name' => $request->input('nama')]);
        $request->merge(['user_level' => 'Kontraktor']);
        $user = $this->userRepository->save($request);

        $request->merge(['user_id' => $user->id]);
        if (!$request->has('id'))
            $kontraktor = $this->kontraktor->create($request->all());
        else {
            $kontraktor = $this->kontraktor->find($request->input('id'));
            $kontraktor->update($request->all());
        }
        if ($request->has('ajax')) return $kontraktor;
        return redirect()->route('kontraktor')
            ->with('success', 'Kontraktor berhasil disimpan');
    }

    public function delete(Request $request)
    {
        if (!$request->has('id')) return abort(404);
        $kontraktor = $this->kontraktor->find($request->input('id'));
        $kontraktor->delete();
        if ($request->has('ajax')) return $kontraktor;
        return redirect()->route('kontraktor')
            ->with('success', 'Kontraktor berhasil dihapus');
    }
}
