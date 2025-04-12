@extends('layouts.main')

@section('title', __('تفاصيل الدورة: :courseName', ['courseName' => $course->name]))

@section('content')
<div class="container py-5">

    <!-- عنوان الدورة -->
    <h1 class="mb-3">{{ __($course->title) }}</h1>
    
    <!-- وصف الدورة -->
    <p class="lead">{{ __($course->description) }}</p>

    <!-- الفيديو -->
    <div class="ratio ratio-16x9 mb-4">
        <iframe src="{{ $course->video_url }}" title="{{ $course->title }}" allowfullscreen></iframe>
    </div>

    <!-- سعر الدورة -->
    <div class="mb-5 d-flex align-items-center gap-3">
        <h5>
            <strong>{{ __('السعر') }}:</strong> {{ $course->price }}$
        </h5>
        <button class="btn btn-dark rounded-3">{{ __('شراء الآن') }}</button>
    </div>

</div>
@endsection