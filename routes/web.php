<?php

use App\Models\Userdetail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SigninController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return view('home.index');
});

// Home
Route::get('/home', [HomeController::class, 'index']);

// Sign Up
Route::get('/signup', [SignupController::class, 'index'])->middleware('guest');
Route::post('/signup', [SignupController::class, 'store']);

// Sign In
Route::get('/signin', [SigninController::class, 'index'])->name('login')->middleware('guest'); //route bernama login ada di /app/middleware/authenticate.php
Route::post('/signin', [SigninController::class, 'authenticate']);

// Sign Out
Route::post('/signout', [SigninController::class, 'signout']);

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// Article
Route::get('/article', [ArticleController::class, 'index']);

// Profile
Route::get('/profile', [ProfileController::class, 'index']);
Route::get('/profile/{user}/edit', [ProfileController::class, 'edit']);
Route::patch('/profile/{user}', [ProfileController::class, 'update']);
Route::patch('/profile/{user}/photo', [ProfileController::class, 'updatePhoto']);
Route::delete('/profile/{user}', [ProfileController::class, 'destroy']);