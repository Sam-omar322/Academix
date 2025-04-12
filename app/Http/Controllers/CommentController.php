<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Course;

class CommentController extends Controller
{
    public function index() {
        return redirect("/");
    }
    public function store(Course $course) {
        $data = request()->validate([
            'content' => 'required'
        ]);

        $course->comments()->create([
            'user_id' => auth()->id(),
            'content' => request('content')
        ]);

        return back();
    }
}
