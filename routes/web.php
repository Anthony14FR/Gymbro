<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ProgramController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/email/verify-new-email/{token}', [EmailVerificationController::class, 'verifyNewEmail'])->name('verify.new.email');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Exercises
Route::middleware('auth')->group(function () {
    Route::get('/exercises', [ExerciseController::class, 'index']);
});

// Programs
Route::middleware('auth')->group(function () {
    Route::get('/programs/edit/{id?}', [ProgramController::class, 'edit'])->name('programs.edit');
    Route::post('/programs', [ProgramController::class, 'store'])->name('programs.store');
    Route::put('/programs/{program}/exercises/{exerciseProgram}', [ProgramController::class, 'updateExercise'])->name('programs.updateExercise');
    Route::post('/programs/{program}/exercises', [ProgramController::class, 'addExercise']);
    Route::delete('/programs/{program}/exercises/{exerciseProgram}', [ProgramController::class, 'removeExercise'])->name('programs.removeExercise');
    Route::post('/programs/{program}/save', [ProgramController::class, 'saveProgram']);
    Route::resource('programs', ProgramController::class)->except(['edit', 'update', 'store']);
});


require __DIR__ . '/auth.php';
