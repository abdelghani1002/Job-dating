<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = Skill::latest()->paginate(5);
        return view("admin.skills.index", compact("skills"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSkillRequest $request)
    {
        Skill::create($request->validated());
        return redirect()->route("skills.index", [], 201)->with('success', "Skill created successfully.");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSkillRequest $request)
    {
        $newData = $request->validated();
        $skill = Skill::find($newData['id']);
        $skill->update($newData);
        return redirect()->route("skills.index")->with('success', "Skill updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route("skills.index")->with('success', "Skill deleted successfully.");
    }
}
