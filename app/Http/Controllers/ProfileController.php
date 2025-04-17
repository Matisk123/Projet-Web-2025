<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function updateProfile(ProfileUpdateRequest $request): RedirectResponse
    {


        $user = $request->user();
        $validated = $request->validated();

        $user->fill($request->validated());

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updateEmail(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Update the email
        $user->email = $request->validated()['email'];

        // If the email is updated, mark email as unverified
        $user->email_verified_at = null;

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'email-updated');
    }
    public function updatePassword(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);
        $user = $request->user();

        // Vérification que le mot de passe actuel est correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Mise à jour du mot de passe
        $user->password = Hash::make($request->password);
        $user->save();

        // Déconnexion de l'utilisateur après la mise à jour du mot de passe
        Auth::logout();

        return Redirect::route('profile.edit')->with('status', 'password-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Your account has been successfully deleted.');
    }
}
