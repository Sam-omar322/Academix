<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    // Display a listing of courses
    public function index()
    {
        $courses = Course::all();
        $title = 'Courses';
        return view('admin.courses.index', compact('courses', 'title'));
    }

    // Show the form for creating a new course
    public function create()
    {
        $title = 'Add New Course';
        return view('admin.courses.create', compact('title'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0|max:9999',
            'video' => 'nullable|mimes:mp4,mov,avi|max:51200',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        
        // حفظ صورة المصغرة (thumbnail)
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }
            
        // حفظ الفيديو داخل مجلد videos
        if ($request->hasFile('video_url')) {
            $videoPath = $request->file('video_url')->store('videos', 'public');
        }
        
        // إنشاء الدورة
        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'video_url' => 'storage/' . $videoPath, // نحفظ الرابط فقط
            'thumbnail' => 'storage/' . $thumbnailPath,
        ]);

        Session::flash('flash_message', 'Course Added successfully.');
        return redirect()->route('courses.index');
    }

    // Display the specified course
    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('admin.courses.show', compact('course'));
    }

    // Show the form for editing the specified course
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $title = 'Edit Course';
        return view('admin.courses.edit', compact('course', 'title'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0|max:9999',
            'video_url' => 'nullable|mimes:mp4,mov,avi|max:51200',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $course->title = $request->title;
        $course->description = $request->description;
        $course->price = $request->price;

        // حذف الصورة القديمة إذا وُجدت ثم رفع صورة جديدة
        if ($request->hasFile('thumbnail')) {
            if ($course->thumbnail) {
                $thumbnailPath = str_replace('storage/', '', $course->thumbnail);
                if (Storage::disk('public')->exists($thumbnailPath)) {
                    Storage::disk('public')->delete($thumbnailPath);
                }
            }

            $newThumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
            $course->thumbnail = 'storage/' . $newThumbnail;
        }

        // حذف الفيديو القديم إذا وُجد ثم رفع فيديو جديد
        if ($request->hasFile('video_url')) {
            if ($course->video_url) {
                $videoPath = str_replace('storage/', '', $course->video_url);
                if (Storage::disk('public')->exists($videoPath)) {
                    Storage::disk('public')->delete($videoPath);
                }
            }

            $newVideo = $request->file('video_url')->store('videos', 'public');
            $course->video_url = 'storage/' . $newVideo;
        }

        $course->save();

        Session::flash('flash_message', 'Course Update successfully.');
        return redirect()->route('courses.index')->with('success', 'تم تحديث الدورة بنجاح');
    }

    // Remove the specified course from storage
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
    
        // Remove "storage/" from the beginning of the path before deleting
        $videoPath = str_replace('storage/', '', $course->video_url);
        $thumbnailPath = str_replace('storage/', '', $course->thumbnail);
    
        if ($videoPath && Storage::disk('public')->exists($videoPath)) {
            Storage::disk('public')->delete($videoPath);
        }
    
        if ($thumbnailPath && Storage::disk('public')->exists($thumbnailPath)) {
            Storage::disk('public')->delete($thumbnailPath);
        }
    
        $course->delete();
    
        Session::flash('flash_message', 'تم حذف الدورة بنجاح.');
        return redirect()->route('courses.index');
    }

    public function showAllCourses()
    {
        $courses = Course::orderBy('created_at', 'desc')->paginate(4);
        return view('courses.index', compact('courses'));
    }    

    public function showDetails($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.details', compact('course'));
    }

    public function watch(Course $course)
    {
        $user = auth()->user();
    
        $hasAccess = $user->myCourses()->where('course_id', $course->id)->exists();
    
        if (! $hasAccess) {
            return redirect('/');
        }
    
        return view('courses.watch', compact('course'));
    }
}
