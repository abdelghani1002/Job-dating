<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'skills' => Skill::all(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $old_photo = public_path("storage/photos/" . $request->user()->photo);
        $request->user()->fill($request->validated());
        if ($request->hasFile('photo')) {
            if (file_exists($old_photo)) {
                unlink($old_photo);
            }
            $photoName = uniqid("photo_") . '.' . $request->photo->extension();
            $request->photo->move(public_path('storage/photos'), $photoName);
            $request->user()->photo = $photoName;
        }

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();
        if ($user->photo) {
            unlink(public_path('storage/photos/') . $user->photo);
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Update user's skills
     */
    public function update_skills(Request $request, User $student)
    {
        $skillIds = $request->input('skills', []);
        $skills = Skill::whereIn('id', $skillIds)->get();
        $student->update_skills($skills);
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
}
