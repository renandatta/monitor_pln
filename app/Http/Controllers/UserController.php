<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $user, $userRepository;
    public function __construct(User $user, UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->user = $user;
        $this->userRepository = $userRepository;
        view()->share(['title' => 'User Program']);
    }

    public function index()
    {
        return view('user.index');
    }

    public function search(Request $request)
    {
        $users = $this->user;
        if ($request->has('name') && $request->input('name') != '')
            $users = $users->where('name', 'like', '%'. $request->input('name') .'%');
        if ($request->has('ajax')) return $users->get();
        $users = $request->has('paginate') ?
            $users->paginate($request->input('paginate')) :
            $users->get();
        return view('user._table', compact('users'));
    }

    public function info(Request $request)
    {
        $user = $request->has('id') ? $this->user->find($request->input('id')) : [];
        return view('user.info', compact('user'));
    }

    public function save(Request $request)
    {
        if ($request->has('password') && $request->input('password') != '')
            $request->merge(['password' => Hash::make($request->input('password'))]);
        else
            $request->request->remove('password');

        $user = $this->userRepository->save($request);

        if ($request->has('ajax')) return $user;
        return redirect()->route('user')
            ->with('success', 'User berhasil disimpan');
    }

    public function delete(Request $request)
    {
        if (!$request->has('id')) return abort(404);
        $user = $this->user->find($request->input('id'));
        $user->delete();
        if ($request->has('ajax')) return $user;
        return redirect()->route('user')
            ->with('success', 'User berhasil dihapus');
    }
}
