<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Announcement;
use App\Models\Company;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // $admin = \App\Models\User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@admin.com',
        //     'photo' => "default.png",
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('AZER1234'),
        // ]);

        // $student = \App\Models\User::factory()->create([
        //     'name' => 'abdelghani',
        //     'email' => 'abd@elghani.com',
        //     'photo' => "default.png",
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('AZER1234'),
        // ]);
        // $admin_role = Role::create(['name' => "admin"]);
        $student_role = Role::where('name', '=', "student");
        // $admin->assignRole([$admin_role]);
        // $student->assignRole([$student_role]);
        // User::factory(20)->create();
        $student_role = Role::where('name', '=', "student")->firstOrFail();



        // Skill::factory(20)->create();
        // Company::factory(20)->create();
        // Announcement::factory(20)->create();
    }
}
