<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function toggleAdmin(User $user)
    {
        // Voorkom dat admin zichzelf kan ontnemen
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Je kunt je eigen admin-rechten niet intrekken.');
        }

        $user->is_admin = !$user->is_admin;
        $user->save();

        return back()->with('success', 'Gebruikersrol bijgewerkt!');
    }
}