<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RoleSwitcherController extends Controller
{
    // Dans RoleSwitcherController.php
    public function index()
    {
        $recent_users = User::with('roles')->get();
        $roles = \Spatie\Permission\Models\Role::pluck('name');

        return view('admin.role_switcher', compact('recent_users', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate(['role' => 'required|string']);

        $user->syncRoles([$request->input('role')]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'Rôle mis à jour.',
                'role' => $request->input('role'),
            ]);
        }

        return back()->with('status', 'Rôle mis à jour.');
    }
}
