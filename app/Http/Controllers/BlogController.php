<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Display a listing of blogs
    public function index()
    {
        $blogs = Blog::paginate(4);
        return view('blogs.index', compact('blogs'));
    }

    // Store a newly created blog
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $blog = Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user_id,
        ]);

        return response()->json($blog, 201);
    }

    // Display the specified blog
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.show', compact('blog'));
    }

    // Update the specified blog
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update($request->all());
        return response()->json($blog);
    }

    // Remove the specified blog
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return response()->json(['message' => 'Blog deleted successfully']);
    }

    public function showAllBlogs()
    {
        $blogs = Blog::paginate(4);
        return view('blogs.index', compact('blogs'));
    }
    public function showDetails($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.details', compact('blog'));
    }
}
