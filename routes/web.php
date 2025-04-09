<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;

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
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/signup', [SignupController::class, 'index'])->name('signup')->middleware('guest');
Route::post('/signup', [SignupController::class, 'create'])->name('signup.submit')->middleware('guest');

Route::get('/profile', [UserController::class, 'index'])->middleware('auth');
Route::post('/profile', [UserController::class, 'editprofile'])->middleware('auth');
Route::get('/members', [UserController::class, 'members'])->middleware('admin');
Route::post('/makeitadmin', [UserController::class, 'makeitadmin'])->middleware('admin');
Route::delete('/deleteuser', [UserController::class, 'destroy'])->name('user.destroy');

Route::get('/projects', [ProjectsController::class, 'index'])->middleware('auth');
Route::get('/project/{slug}', [ProjectsController::class, 'detail'])->middleware('auth');
Route::post('/startproject', [ProjectsController::class, 'startproject'])->middleware('admin');
Route::post('/endproject', [ProjectsController::class, 'endproject'])->middleware('admin');
Route::post('/deleteproject', [ProjectsController::class, 'deleteproject'])->middleware('admin');
Route::post('/fileproject', [ProjectsController::class, 'fileproject'])->middleware('admin');
Route::post('/project', [ProjectsController::class, 'create'])->name('project.add')->middleware('admin');
Route::post('/updatereport', [ReportController::class, 'update'])->middleware('admin');
Route::post('/projects/update', [ProjectsController::class, 'update'])->name('projects.update');