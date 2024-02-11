<?php

namespace App\Http\Controllers;

use App\Models\Announcement;

class HomeController extends Controller
{
    public function index(){
        $announcements = Announcement::latest()->paginate(6);
        $user = auth()->user();
        if($user !== null){
            $suggestions = $announcements->filter(function ($announcement) use ($user) {
                return $announcement->isSuggestionFor($user);
            });
        }
        return view('home', isset($suggestions) ? compact("announcements", "suggestions") : compact("announcements"));
    }
}
