<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // NIEUW: Handmatig gebruiker aanmaken
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => strtolower(str_replace(' ', '_', $request->name)),
            'password' => Hash::make($request->password),
            'is_admin' => $request->has('is_admin') ? 1 : 0,
        ]);

        return back()->with('success', 'Nieuwe gebruiker succesvol aangemaakt!');
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

    // NIEUW: Gebruiker verwijderen
    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Je kunt jezelf niet verwijderen.');
        }

        $user->delete();

        return back()->with('success', 'Gebruiker succesvol verwijderd!');
    }
}