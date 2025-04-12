<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Blog;

class HomeController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        $blogs = Blog::all();
        return view('home.index', compact('courses', 'blogs'));
    }
}
