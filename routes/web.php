<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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

// Course
Route::Resource('courses', CourseController::class);
Route::get('/courses/{course}/watch', [CourseController::class, 'watch'])
    ->name('courses.watch');

// Blogs
Route::Resource('blogs', BlogController::class);

// Comment
Route::post('/c/{course:id}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/c/{course:id}/comments', [CommentController::class, 'index'])->name('comments.index');

Route::get('/', [HomeController::class, 'index'])->name('home.index');


// Admin Panel
// Route::prefix('/admin')->middleware(['auth:sanctum', 'check.update.permission', 'verified'])->group(function () {
Route::prefix('/admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    // Route::resource('/books', BookController::class);
    // Route::resource('/categories', CategoryController::class);
    // Route::resource('/authors', AuthorController::class);
    // Route::resource('/publishers', PublisherController::class);
    // Route::resource('/users', UserController::class);
    // Route::get("/allOrders", [PurchaseController::class, 'allOrders'])->name('admin.allorders');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
