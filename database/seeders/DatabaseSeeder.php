<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Stringable;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // \App\Models\User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@admin.com',
        //     'photo' => "default.png",
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('AZER1234'),
        // ]);
        // $role = Role::create(['name' => "admin"]);
        // $admin = \App\Models\User::where('email', '=', 'admin@admin.com');
        // $admin->assignRole('admin');

        \App\Models\User::factory(50)->create();
    }
}
