@extends('layouts.main')

@section('title', 'Home Page')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1 class="display-4 fw-bold">{{ __('مرحبا بك في أكاديمكس') }}</h1>
        <p class="lead mt-3">{{ __('تعلم من أفضل الدورات التعليمية عبر الإنترنت، وابدأ رحلتك اليوم') }}</p>
        <a href="{{ route('courses.index') }}" class="btn btn-light btn-lg mt-4 mb-4">{{ __('تصفح الدورات') }}</a>
    </div>
</section>

<!-- Courses Section -->
<section class="py-5 bg-light rounded-3">
    <div class="container">
        <h2 class="mb-4 text-center">{{ __('الدورات المميزة') }}</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <x-course-card :course="$courses[0]" />
            </div>
            <!-- كرر البطاقات حسب الحاجة -->
        </div>
    </div>
</section>

<!-- Blog Section -->
<section class="py-5">
    <div class="container">
        <h2 class="mb-4 text-center">{{ __('المدونات') }}</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card blog-card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('لماذا تتعلم البرمجة؟') }}</h5>
                        <p class="card-text">{{ __('البرمجة أصبحت من أهم المهارات المطلوبة في سوق العمل الحديث.') }}</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">{{ __('اقرأ المزيد') }}</a>
                    </div>
                </div>
            </div>
            <!-- كرر البطاقات حسب الحاجة -->
        </div>
    </div>
</section>
@endsection