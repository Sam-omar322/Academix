<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BlogController;

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

Route::Resource('courses', CourseController::class);
Route::Resource('blogs', BlogController::class);

// Comment
Route::post('/c/{course:id}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/c/{course:id}/comments', [CommentController::class, 'index'])->name('comments.index');

Route::get('/', function () {
    return view('home.index');
})->name('home.index');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
