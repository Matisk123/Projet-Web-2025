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
     * Show the profile edit form.
     */
    public function edit(Request $request): View
    {
        // Return the edit view with the current user data
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile info (like name, phone, avatar...).
     */
    public function updateProfile(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user(); // Get the current user
        $validated = $request->validated(); // Validate the form data

        // Fill user info with validated data
        $user->fill($validated);

        // If user uploaded a new avatar
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $destinationPath = public_path('metronic/media/avatars');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Move the uploaded file to the destination folder
            $file->move($destinationPath, $fileName);

            // Save the avatar path in the database
            $user->avatar = 'metronic/media/avatars/' . $fileName;
        }

        $user->save(); // Save changes to the database

        // Redirect back with a success message
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's email.
     */
    public function updateEmail(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user(); // Get the current user

        // Set the new email
        $user->email = $request->validated()['email'];

        // Mark the email as not verified anymore
        $user->email_verified_at = null;

        $user->save(); // Save changes

        return Redirect::route('profile.edit')->with('status', 'email-updated');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(ProfileUpdateRequest $request): RedirectResponse
    {
        // Validate the current and new password
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $user = $request->user();

        // Check if the current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update the password (encrypt it)
        $user->password = Hash::make($request->password);
        $user->save();

        // Log out the user after password change
        Auth::logout();

        return Redirect::route('profile.edit')->with('status', 'password-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = $request->user(); // Get the current user

        Auth::logout(); // Log out the user

        $user->delete(); // Delete the user from the database

        // Clear the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to login page with a message
        return redirect()->route('login')->with('status', 'Your account has been successfully deleted.');
    }
}
