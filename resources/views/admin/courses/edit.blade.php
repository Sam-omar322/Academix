@extends('layouts.dashbaord.layout')

@section('title', 'تعديل الدورة')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">{{ $title }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">{{ __('عنوان الدورة') }}</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $course->title }}" required>
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">{{ __('وصف الدورة') }}</label>
            <textarea class="form-control" name="description" id="description" rows="3" required>{{ $course->description }}</textarea>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">{{ __('سعر الدورة') }}</label>
            <input type="number" class="form-control" name="price" id="price" max="999999.99" step="0.01" value="{{ $course->price }}" required>
            @error('price')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="video" class="form-label">{{ __('فيديو الدورة الحالي') }}</label><br>
            <video width="320" height="240" controls>
                <source src="{{ asset($course->video_url) }}" type="video/mp4">
            </video>
        </div>

        <div class="mb-3">
            <label for="video_url" class="form-label">{{ __('تغيير فيديو الدورة') }}</label>
            <input type="file" class="form-control" name="video_url" id="video_url" accept="video/*">
            @error('video_url')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="thumbnail" class="form-label">{{ __('صورة الدورة الحالية') }}</label><br>
            <img src="{{ asset($course->thumbnail) }}" width="150" alt="Thumbnail">
        </div>

        <div class="mb-3">
            <label for="thumbnail" class="form-label">{{ __('تغيير الصورة المصغرة') }}</label>
            <input type="file" class="form-control" name="thumbnail" id="thumbnail">
            @error('thumbnail')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ __('تحديث الدورة') }}</button>
    </form>
</div>
@endsection
