<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Http\Requests\StoreAnnouncementRequest;
use App\Http\Requests\UpdateAnnouncementRequest;
use App\Models\Company;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements = Announcement::withTrached()->latest()->paginate(6);
        return view('admin.announcements.index', ["announcements" => $announcements]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        return view("admin.announcements.create", compact("companies"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnnouncementRequest $request)
    {
        $parteners = $request->parteners;
        if ($parteners[0] == null) {
            return redirect()->back()->withErrors(["parteners" => "Parteners are required"])->withInput();
        }
        $announcement = new Announcement($request->validated());
        $announcement->save();
        $announcement->addParteners($parteners);
        return redirect()->route("announcements.index", [], 201)->with('success', "Announcement created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        $parteners = $announcement->companies;
        return view("admin.announcements.show", compact(['announcement', 'parteners']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        $companies = Company::all();
        return view("admin.announcements.edit", compact(['announcement', 'companies']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnnouncementRequest $request, Announcement $announcement)
    {
        $parteners = $request->parteners;
        if ($parteners[0] == null) {
            return redirect()->back()->withErrors(["parteners" => "Parteners are required"])->withInput();
        }
        $announcement->update($request->validated());
        $announcement->addParteners($parteners);
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
}
