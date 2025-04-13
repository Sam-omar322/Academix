<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\Blog;

class AdminController extends Controller
{
    public function index() {
        $n_of_courses = Course::all()->count();
        $n_of_students = User::where('role', 'student')->count();
        $n_of_blogs = Blog::all()->count();

        return view("admin.index", compact("n_of_courses", "n_of_students", "n_of_blogs"));
    }
}
