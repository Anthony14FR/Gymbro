<?php

use App\Http\Controllers\MailController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;



Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/email/verify-new-email/{token}', [EmailVerificationController::class, 'verifyNewEmail'])->name('verify.new.email');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile
Route::middleware('auth', )->group(function () {
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
    Route::get('/programs/{id}/export-csv', [ProgramController::class, 'exportCsv'])->name('programs.exportCsv');
});

// Users
Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
});


// Subscriptions
Route::middleware('auth')->group(function () {
    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::post('/subscriptions', [SubscriptionController::class, 'create'])->name('subscriptions.create');
    Route::get('/subscriptions/success', [SubscriptionController::class, 'success'])->name('subscriptions.success');
    Route::get('/subscriptions/cancel', [SubscriptionController::class, 'cancel'])->name('subscriptions.cancel');
    Route::post('/subscriptions/unsubscribe', [SubscriptionController::class, 'unsubscribe'])->name('subscriptions.unsubscribe');
});

//Emails
Route::middleware('auth')->group(function (){
    Route::post('send-mail', [MailController::class, 'sendMail'])->name('send.mail');
});

require __DIR__ . '/auth.php';
