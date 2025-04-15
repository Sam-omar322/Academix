@extends('layouts.main')

@section('title', __('صفحة الرئبسية'))

@section('content')

<!-- Banner Section -->
<section class="banner text-white text-center d-flex align-items-center" style="background: url('{{ asset('storage/images/hero.webp') }}') no-repeat center center; background-size: cover; min-height: 60vh; position: relative; padding: 150px 0;">
    {{-- Add an overlay for better text contrast --}}
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.5);"></div>

    <div class="container" style="position: relative; z-index: 2;">
        <h1 class="display-4 fw-bold">{{ __('مرحبا بك في أكاديمكس') }}</h1>
        <p class="lead mt-3 mb-4">{{ __('اكتشف مجموعة واسعة من الدورات التدريبية عالية الجودة المقدمة من خبراء الصناعة. ابدأ رحلتك التعليمية معنا اليوم!') }}</p>
        <a href="{{ route('courses.showAll') }}" class="btn btn-primary btn-lg">{{ __('تصفح جميع الدورات') }}</a>
    </div>
</section>
{{-- Note: Replace '{{ asset('images/your-banner-image.jpg') }}' with the actual path to your banner image --}}


<!-- Courses Section -->
<section id="courses" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">{{ __('أحدث الدورات التدريبية') }}</h2>
            <p class="text-muted">{{ __('استكشف أحدث الدورات المضافة لدينا في مجالات متنوعة.') }}</p>
        </div>
        <div class="row g-4">
            @forelse($courses as $course)
                <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
                    {{-- Assuming x-course-card renders a full card structure --}}
                    <x-course-card :course="$course" />
                </div>
            @empty
                <div class="col-12 text-center">
                    <div class="alert alert-info" role="alert">
                        {{ __('لا توجد دورات متاحة حاليًا. يرجى التحقق مرة أخرى قريبًا!') }}
                    </div>
                </div>
            @endforelse
        </div>
         {{-- Optional: Add a "View All" button here if needed, although the banner has one --}}
         {{-- <div class="text-center mt-5">
             <a href="{{ route('courses.showAll') }}" class="btn btn-outline-primary">{{ __('عرض كل الدورات') }}</a>
         </div> --}}
    </div>
</section>


<!-- Blog Section -->
<section id="blog" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">{{ __('أحدث المقالات والأخبار') }}</h2>
            <p class="text-muted">{{ __('ابق على اطلاع بآخر المستجدات والنصائح والمقالات التعليمية من مدونتنا.') }}</p>
        </div>

        @if ($blogs->isNotEmpty())
            <div id="blogCarousel" class="carousel slide" data-bs-ride="carousel">
                {{-- Indicators --}}
                <div class="carousel-indicators">
                    @foreach ($blogs as $key => $blog)
                        <button type="button" data-bs-target="#blogCarousel" data-bs-slide-to="{{ $key }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="{{ $loop->first ? 'true' : 'false' }}" aria-label="Slide {{ $key + 1 }}"></button>
                    @endforeach
                </div>

                {{-- Slides --}}
                <div class="carousel-inner">
                    @foreach ($blogs as $blog)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            {{-- Center the card within the slide --}}
                            <div class="d-flex justify-content-center p-4">
                                <div class="card blog-card shadow-sm" style="max-width: 700px;"> {{-- Adjust max-width as needed --}}
                                    {{-- Optional: Add Blog Image Here if available --}}
                                    {{-- <img src="..." class="card-img-top" alt="{{ $blog->title }}"> --}}
                                    <div class="card-body text-center"> {{-- Centered text inside card --}}
                                        <h5 class="card-title fw-bold">{{ $blog->title }}</h5>
                                        {{-- Limit content length for preview --}}
                                        <p class="card-text text-muted">{{ Str::limit($blog->content, 150, '...') }}</p>
                                        <a href="{{ route('blogs.details', $blog) }}" class="btn btn-outline-primary btn-sm mt-2">{{ __('اقرأ المزيد') }}</a>
                                    </div>
                                    {{-- Optional: Add publication date or author --}}
                                     {{-- <div class="card-footer text-muted">
                                        نشر في: {{ $blog->created_at->format('Y-m-d') }}
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Controls --}}
                <button class="carousel-control-prev" type="button" data-bs-target="#blogCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#blogCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
             {{-- Optional: Add a "View All" button here --}}
             <div class="text-center mt-5">
                 <a href="{{ route('blogs.showAll') }}" class="btn btn-outline-primary">{{ __('عرض كل المقالات') }}</a>
             </div>
        @else
            <div class="col-12 text-center">
                 <div class="alert alert-info" role="alert">
                     {{ __('لا توجد مقالات متاحة حاليًا.') }}
                 </div>
            </div>
        @endif
    </div>
</section>

@endsection
