<?php

namespace App\Http\Controllers;

use App\Models\Announcement;

class HomeController extends Controller
{
    public function index(){
        $user = auth()->user();
        $announcements = Announcement::latest()->paginate(6);
        $suggestions = $announcements->filter(function ($announcement) use ($user) {
            return $announcement->isSuggestionFor($user);
        });
        return view('home', compact("announcements", "suggestions"));
    }
}
