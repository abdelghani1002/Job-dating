<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Students count
        $students_count = $students_count = User::whereHas('roles', function ($query) {
            $query->where('name', 'student');
        })->count();

        // Announcements count
        $announcements_count = Announcement::count();

        // Companies count
        $companies_count = Company::count();

        // Applyed announcements
        $skill_matching_rate = 1;

        // Announcements applyed for
        $application_activity = DB::table('candidates')->count();

        // Latest users (last month)
        $new_users_count = User::where('created_at', '>=', now()->subMonth())->count();

        return view('dashboard', [
            "students_count" => $students_count,
            "announcements_count" => $announcements_count,
            "companies_count" => $companies_count,
            "skill_matching_rate" => $skill_matching_rate,
            "application_activity" => $application_activity,
            "new_users_count" => $new_users_count,
        ]);
    }
}
