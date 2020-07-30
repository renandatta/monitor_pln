<?php

namespace App\Http\Controllers;

use App\Petugas;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    private $petugas, $userRepository;
    public function __construct(Petugas $petugas, UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->petugas = $petugas;
        $this->userRepository = $userRepository;
        view()->share(['title' => 'Petugas']);
    }

    public function index()
    {
        return view('petugas.index');
    }

    public function search(Request $request)
    {
        $petugas = $this->petugas;
        if ($request->has('nama') && $request->input('nama') != '')
            $petugas = $petugas->where('nama', 'like', '%'. $request->input('nama') .'%');
        if ($request->has('ajax')) return $petugas->get();
        $petugas = $request->has('paginate') ?
            $petugas->paginate($request->input('paginate')) :
            $petugas->get();
        return view('petugas._table', compact('petugas'));
    }

    public function info(Request $request)
    {
        $petugas = $request->has('id') ? $this->petugas->find($request->input('id')) : [];
        return view('petugas.info', compact('petugas'));
    }

    public function save(Request $request)
    {
        if ($request->has('password') && $request->input('password') != '')
            $request->merge(['password' => Hash::make($request->input('password'))]);
        else
            $request->request->remove('password');

        $request->merge(['name' => $request->input('nama')]);
        $request->merge(['user_level' => 'Petugas']);
        $user = $this->userRepository->save($request);

        $request->merge(['user_id' => $user->id]);
        if (!$request->has('id'))
            $petugas = $this->petugas->create($request->all());
        else {
            $petugas = $this->petugas->find($request->input('id'));
            $petugas->update($request->all());
        }
        if ($request->has('ajax')) return $petugas;
        return redirect()->route('petugas')
            ->with('success', 'Petugas berhasil disimpan');
    }

    public function delete(Request $request)
    {
        if (!$request->has('id')) return abort(404);
        $petugas = $this->petugas->find($request->input('id'));
        $petugas->delete();
        if ($request->has('ajax')) return $petugas;
        return redirect()->route('petugas')
            ->with('success', 'Petugas berhasil dihapus');
    }
}
