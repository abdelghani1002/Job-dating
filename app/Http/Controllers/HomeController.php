<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $announcements = Announcement::latest()->paginate(9);
        foreach ($announcements as &$announcement) {
            $announcement->start_date = Carbon::create($announcement->start_date)->diffForHumans();
        }
        return view('home', ["announcements" => $announcements]);
    }
}
