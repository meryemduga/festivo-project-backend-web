<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Publiek profiel bekijken
    public function showProfile($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('profile.show', compact('user'));
    }

    // Formulier om eigen profiel te bewerken
    public function editProfile()
    {
        $user = auth()->user();
        return view('profile.edit-custom', compact('user'));
    }

    // Profiel opslaan met profielfoto upload
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'birthday' => 'nullable|date',
            'bio' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            // Verwijder oude foto als die bestaat
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Sla nieuwe foto op in storage/app/public/profiles
            $path = $request->file('profile_picture')->store('profiles', 'public');
            $validated['profile_picture'] = $path;
        }

        $user->update($validated);

        return redirect()->route('profile.show', $user->username)->with('success', 'Profiel bijgewerkt!');
    }
}