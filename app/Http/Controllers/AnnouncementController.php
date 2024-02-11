<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Http\Requests\StoreAnnouncementRequest;
use App\Http\Requests\UpdateAnnouncementRequest;
use App\Models\Company;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements = Announcement::latest()->paginate(6);
        return view('admin.announcements.index', ["announcements" => $announcements]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        $skills = Skill::all();
        return view("admin.announcements.create", compact(['companies', 'skills']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnnouncementRequest $request)
    {
        $partenersIds = $request->input('parteners', []);
        $parteners = Company::whereIn('id', $partenersIds)->get();
        if (count($parteners) === 0) {
            return redirect()->back()->withErrors(["parteners" => "Parteners are required"])->withInput();
        }
        $skillIds = $request->input('skills', []);
        $skills = Skill::whereIn('id', $skillIds)->get();
        if (count($skills) === 0) {
            return redirect()->back()->withErrors(["skills" => "Skills are required"])->withInput();
        }
        $announcement = new Announcement($request->validated());
        $announcement->save();
        $announcement->update_parteners($parteners);
        $announcement->update_skills($skills);
        return redirect()->route("announcements.index", [], 201)->with('success', "Announcement created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        $parteners = $announcement->companies;
        $skills = $announcement->skills;
        return view("admin.announcements.show", compact(['announcement', 'parteners', 'skills']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        $companies = Company::all();
        $skills = Skill::all();
        return view("admin.announcements.edit", compact(['announcement', 'companies', 'skills']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnnouncementRequest $request, Announcement $announcement)
    {
        $partenersIds = $request->input('parteners', []);
        $parteners = Company::whereIn('id', $partenersIds)->get();
        if (count($parteners) === 0) {
            return redirect()->back()->withErrors(["parteners" => "Parteners are required"])->withInput();
        }
        $skillIds = $request->input('skills', []);
        $skills = Skill::whereIn('id', $skillIds)->get();
        if (count($skills) === 0) {
            return redirect()->back()->withErrors(["skills" => "Skills are required"])->withInput();
        }
        $announcement->update($request->validated());
        $announcement->update_parteners($parteners);
        $announcement->update_skills($skills);
        return redirect()->route("announcements.index", [], 201)->with('success', "Announcement updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->removeParteners($announcement->companies);
        $announcement->delete();
        return redirect()->back()->with("success", "Announcement has deleted successfully");
    }

    /**
     * Add a student candidate.
     */
    public function apply(Announcement $announcement)
    {
        $student = Auth::user();
        if (!$student->applyed_announcements->contains($announcement)) {
            if ($student->apply_to_announcement($announcement))
                return redirect()->back()->with("success", "Your candidat has been registred");
            return redirect()->back()->with("error", "Error withen candidates!");
        }
        return redirect()->back()->with("infos", "You already applyed for this announcement!");
    }
}
