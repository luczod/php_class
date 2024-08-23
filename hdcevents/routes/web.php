<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;


Route::get('/', [EventController::class, 'index']);
Route::get('/events/create', [EventController::class, 'create'])->middleware('auth');;
Route::get('/events/{id}', [EventController::class, 'show']);
Route::post('/events', [EventController::class, 'store'])->middleware('auth'); // treaty
Route::delete('/events/{id}', [EventController::class, 'destroy'])->middleware('auth'); // treaty
Route::get('/events/edit/{id}', [EventController::class, 'edit'])->middleware('auth');
Route::post('/events/update/{id}', [EventController::class, 'update'])->middleware('auth'); // put


/* Route::get('/contact', function () {
    return view('contact');
}); */

Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');
Route::post('/events/join/{id}', [EventController::class, 'joinEvent'])->middleware('auth');
Route::delete('/events/leave/{id}', [EventController::class, 'leaveEvent'])->middleware('auth');

/* Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
}); */
