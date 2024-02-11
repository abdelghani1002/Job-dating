<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(6);
        return view("admin.users.index", compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return view('profile.edit', [
            'user' => $user,
            'skills' => Skill::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $skills = Skill::all();
        return view("admin.users.edit", compact(['user', 'skills']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $old_photo = public_path("storage/photos/" . $request->user()->photo);
        $skillsIds = $request->input('skills', []);;
        $skills = Skill::whereIn('id', $skillsIds)->get();
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'photo' => "bail|file|mimes:jpeg,png,jpg,gif,svg|max:5120",
            'role' => "required"
        ]);
        if ($request->hasFile('photo')) {
            if (file_exists($old_photo)) {
                unlink($old_photo);
            }
            $photoName = uniqid("photo_") . '.' . $request->photo->extension();
            $request->photo->move(public_path('storage/photos'), $photoName);
            $data['photo'] = $photoName;
        }
        $user->update($data);
        $user->update_skills($skills);
        // role
        $user->syncRoles([$request->role]);
        return redirect()->route('users.index')->with('success', 'User Infos updated successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with("success", "User has deleted successfully");
    }
}
