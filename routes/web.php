<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Home page */

Route::get('/', [HomeController::class,'index'])->name("home");

/* Dashboard */
Route::prefix("dashboard")->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [AdminController::class, "dashboard"])->name("dashboard");

    /* User resource */
    Route::resource('users', UserController::class)->except(["create", "store"]);

    /* Companies resource */
    Route::resource('companies', CompanyController::class);

    /* Announcements resource */
    Route::resource('announcements', AnnouncementController::class)->except(['show']);

    /* Skills resource */
    Route::resource('skills', SkillController::class)->except(['show', 'edit', 'create', 'update']);
    Route::put('/skills', [SkillController::class, "update"]);
});
Route::get('/announcements/{announcement}', [AnnouncementController::class, 'show'])->name("announcements.show");

/* Auth */
Route::middleware('auth')->group(function () {
    Route::put('/profile/update_skills/{student}', [ProfileController::class, 'update_skills'])->name('profile.update_skills');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
