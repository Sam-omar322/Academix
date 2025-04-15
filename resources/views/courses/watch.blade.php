@extends('layouts.main')
@section('title', __('مشاهدة الدورة: :courseName', ['courseName' => $course->name]))

@section('content')
<h1>{{$course->id}}</h1>


    <!-- الفيديو -->
    <div class="ratio ratio-16x9 mb-4">
        <video width="100%" height="300" controls preload="none">
            <source src="{{ asset($course->video_url) }}" type="video/mp4">
            {{ __('المتصفح لا يدعم تشغيل الفيديو.') }}
        </video>
    </div>
    
   <!-- التعليقات -->
   <h3 class="mb-4">{{ __('التعليقات') }}</h3>

@foreach ($course->comments as $comment)
    <div class="mb-3 p-3 border rounded shadow-sm">
        <strong>{{ $comment->user->name }}</strong>
        <p class="mb-0">{{ $comment->content }}</p>
    </div>
@endforeach

<!-- نموذج إضافة تعليق -->
@auth
<form action="{{ route('comments.store', $course->id) }}" method="POST" class="mt-5">
    @csrf
    <div class="mb-3">
        <label for="content" class="form-label">{{ __('أضف تعليقك') }}</label>
        <textarea name="content" class="form-control" rows="4" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">{{ __('نشر التعليق') }}</button>
</form>
@else
    <p>{{ __('يرجى تسجيل الدخول لإضافة تعليق.') }}</p>
@endauth
@endsection