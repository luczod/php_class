<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

/*
In the web.php file, all the routes by default are CSRF protected.
Route::get('/', function () {
    return view('welcome');
}); */

Route::group(['prefix' => '/', 'as' => 'tasks.'], function () {
    Route::get('/', [TaskController::class, 'index'])->name('index');
});
