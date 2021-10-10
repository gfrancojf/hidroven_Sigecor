<?php

namespace App\Http\Controllers\admin;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
class perController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function edit(User $user)
   
    { $roles = Role::all();
        return view('admin.users.UserEdit', compact ('user', 'roles'));
    }
 
    public function update(Request $request,User $user)
    {
        $user->roles()->sync($request->roles);
        return redirect()->route('users.edit', $user)->with('info', 'Se Asigno Correctamente');
    }

}
