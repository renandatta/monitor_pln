<?php

namespace App\Repositories;

use App\User;
use Illuminate\Http\Request;

class UserRepository
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function save(Request $request)
    {
        $id = $request->has('user_id') ? $request->input('user_id') : $request->input('id');
        if (!$request->has('id'))
            $user = $this->user->create($request->all());
        else {
            $user = $this->user->find($id);
            $user->update($request->all());
        }
        return $user;
    }
}
