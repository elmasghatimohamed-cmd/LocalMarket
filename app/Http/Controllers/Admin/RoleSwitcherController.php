<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RoleSwitcherController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(20);
        $roles = \Spatie\Permission\Models\Role::pluck('name');

        return view('admin.role_switcher', compact('users', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([ 'role' => 'required|string' ]);

        $user->syncRoles([$request->input('role')]);

        return redirect()->route('admin.role_switcher')->with('status', 'Rôle mis à jour.');
    }
}
