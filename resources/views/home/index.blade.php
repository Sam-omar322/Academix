@extends('layouts.main')

@section('title', 'Home Page')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1 class="display-4 fw-bold">{{ __('مرحبا بك في أكاديمكس') }}</h1>
        <p class="lead mt-3">{{ __('تعلم من أفضل الدورات التعليمية عبر الإنترنت، وابدأ رحلتك اليوم') }}</p>
    </div>
</section>

<!-- Courses Section -->
<a href="{{ route('courses.showAll') }}" class="btn btn-light btn-lg mt-4 mb-4">{{ __('تصفح الدورات') }}</a>
<section class="py-5 bg-light rounded-3">
    <div class="container">
        <h2 class="mb-4 text-center">{{ __('أحدث الدورات') }}</h2>
        <div class="row g-4">
        @forelse($courses as $course)
            <div class="col-md-4">
                <x-course-card :course="$course" />
            </div>
        @empty
            <div class="col-12 text-center">
                <p>{{ __('لا توجد دورات متاحة حاليًا.') }}</p>
            </div>
        @endforelse
        </div>
    </div>
</section>

<div style="margin-top: 100px"></div>

<!-- Blog Section -->
<a href="{{ route('blogs.showAll') }}" class="btn btn-light btn-lg mt-4 mb-4">{{ __('عرض جميع المقالات') }}</a>
<section class="py-5">
    <div class="container">
        <h2 class="mb-4 text-center">{{ __('المدونات') }}</h2>
        <div class="row g-4">
        @forelse($blogs as $blog)
            <div class="col-md-4">
                <div class="card blog-card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        <p class="card-text">{{ $blog->content }}</p>
                        <a href="{{ route('blogs.details', $blog) }}" class="btn btn-outline-primary btn-sm">{{ __('اقرأ المزيد') }}</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p>{{ __('لا توجد دورات متاحة حاليًا.') }}</p>
            </div>
        @endforelse
            <!-- كرر البطاقات حسب الحاجة -->
        </div>
    </div>
</section>
@endsection