<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;


Route::get('/',[EventController::class,'index']);
Route::get('/events/create',[EventController::class,'create']);

Route::get('/contact', function () {
    return view('contact');
});
