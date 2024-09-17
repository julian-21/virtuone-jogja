<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function userList()
    {
        $users = User::all();
        return view('auth.user', compact('users'));
    }

    public function showChangePasswordForm(User $user)
    {
        return view('auth.change_password', ['user' => $user]);
    }

    public function changePassword(Request $request, User $user)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            return redirect()->route('user.list')->with('success', 'Password changed successfully for ' . $user->name);
        }

        return redirect()->back()->withErrors(['current_password' => 'Incorrect current password']);
    }

    public function activate(User $user)
    {
        $user->update(['is_active' => 'yes']);

        return redirect()->route('user.list')->with('success', 'User activated successfully.');
    }

    public function deactivate(User $user)
    {
        $user->update(['is_active' => 'no']);

        return redirect()->route('user.list')->with('success', 'User deactivated successfully.');
    }

    public function editRole(User $user)
    {
        return view('auth.edit-role', compact('user'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:ADMIN,VA,PETUGAS,USER',
        ]);

        $user->update([
            'role' => $request->role,
        ]);

        return redirect()->route('user.list')->with('success', 'User role updated successfully.');
    }
}
