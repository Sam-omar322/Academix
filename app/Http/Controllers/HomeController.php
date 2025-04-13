<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Blog;

class HomeController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('created_at', 'desc')->paginate(4);
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(4);
        return view('home.index', compact('courses', 'blogs'));
    }
}
