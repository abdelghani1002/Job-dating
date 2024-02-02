<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('home');
})->name("home");

/* Dashboard */
Route::prefix("dashboard")->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [AdminController::class, "dashboard"])->name("dashboard");

    /* Companies resource */
    Route::resource('companies', CompanyController::class);

    /* Announcements resource */
    Route::resource('announcements', AnnouncementController::class);
});

/* Auth */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
