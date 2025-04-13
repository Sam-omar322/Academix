<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
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

// Home
Route::get('/', [HomeController::class, 'index'])->name('home.index');

// Course
Route::get('/courses', [CourseController::class, 'showAllCourses'])->name('courses.showAll');
Route::get('/courses/{course}/details', [CourseController::class, 'showDetails'])->name('courses.details');
Route::get('/courses/{course}/watch', [CourseController::class, 'watch'])->name('courses.watch');

// Blogs
Route::get('/blogs', [BlogController::class, 'showAllBlogs'])->name('blogs.showAll');
Route::get('/blogs/{blog}/details', [BlogController::class, 'showDetails'])->name('blogs.details');


// Comment
Route::post('/c/{course:id}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/c/{course:id}/comments', [CommentController::class, 'index'])->name('comments.index');

// Admin Panel
Route::prefix('/admin')->middleware(['auth:sanctum', 'check.update.permission', 'verified'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::Resource('/courses', CourseController::class);
    Route::Resource('/blogs', BlogController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}/delete', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('layouts.main');
    })->name('dashboard');
});
