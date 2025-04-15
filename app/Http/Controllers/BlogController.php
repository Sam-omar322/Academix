<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        $title = 'Blogs';
        return view('admin.blogs.index', compact('blogs', 'title'));
    }

    public function create()
    {
        $title = 'Add New Blog';
        return view('admin.blogs.create', compact('title'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();
        Blog::create($validated);

        Session::flash('flash_message', __('تم إضافة المدونة بنجاح'));
        return redirect()->route('blogs.index')->with('success', 'Blog created!');
    }

    public function show(Blog $blog)
    {
        return view('admin.blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        $title = 'Edit Blog';
        return view('admin.blogs.edit', compact('blog', 'title'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $blog->update($request->only(['title', 'content']));
        Session::flash('flash_message', __('تم تحديث المدونة بنجاح'));
        return redirect()->route('blogs.index')->with('success', 'Blog updated!');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        Session::flash('flash_message', __('تم حذف المدونة بنجاح'));
        return redirect()->route('blogs.index')->with('success', 'Blog deleted!');
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
