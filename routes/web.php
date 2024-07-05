<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\UserController;



Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/email/verify-new-email/{token}', [EmailVerificationController::class, 'verifyNewEmail'])->name('verify.new.email');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile
Route::middleware('auth' , )->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Exercises
Route::middleware('auth')->group(function () {
    Route::get('/exercises', [ExerciseController::class, 'index'])->name('exercises.index');
});

// Programs
Route::middleware('auth')->group(function () {
    Route::get('/programs/edit/{id?}', [ProgramController::class, 'edit'])->name('programs.edit');
    Route::post('/programs', [ProgramController::class, 'store'])->name('programs.store');
    Route::put('/programs/{program}', [ProgramController::class, 'update'])->name('programs.update');
    Route::put('/programs/{program}/exercises/{exerciseProgram}', [ProgramController::class, 'updateExercise'])->name('programs.updateExercise');
    Route::post('/programs/{program}/exercises', [ProgramController::class, 'addExercise']);
    Route::delete('/programs/{program}/exercises/{exerciseProgram}', [ProgramController::class, 'removeExercise'])->name('programs.removeExercise');
    Route::post('/programs/{program}/save', [ProgramController::class, 'saveProgram']);
    Route::put('/programs/{program}/toggle-status', [ProgramController::class, 'toggleStatus']);
    Route::get('/programs/{id}/export-pdf', [ProgramController::class, 'exportPdf'])->name('programs.exportPdf');
    Route::resource('programs', ProgramController::class)->except(['edit', 'update', 'store']);
    Route::post('/programs/{program}/image', [ProgramController::class, 'saveImage'])->name('programs.saveImage');
});

// Users
Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
});

require __DIR__ . '/auth.php';
