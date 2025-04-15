@extends('layouts.main')

@section('title', __('جميع المقالات'))

@section('content')
<div class="container py-5">

    {{-- Page Header Section --}}
    <div class="text-center mb-5 pb-3 border-bottom">
        <h1 class="display-5 fw-bold">{{ __('أحدث المقالات والأخبار') }}</h1>
        <p class="lead text-muted">{{ __('تابع آخر التحديثات والمواضيع والنصائح التي نشاركها في مدونتنا.') }}</p>
    </div>

    {{-- Optional: Add Filtering/Sorting Section Placeholder here if needed --}}
    {{-- <div class="filter-section mb-5 shadow-sm"> ... Filters for categories/tags ... </div> --}}

    {{-- Blog Post Grid --}}
    <div class="row g-4">
        @forelse($blogs as $blog)
            <div class="col-sm-6 col-lg-4 d-flex align-items-stretch">
                <div class="card h-100 shadow-sm border-0 overflow-hidden"> {{-- Add overflow-hidden if using images --}}

                    {{-- Optional: Blog Post Image --}}
                    {{-- @if($blog->image_url)
                        <a href="{{ route('blogs.details', $blog->id) }}">
                            <img src="{{ $blog->image_url }}" class="card-img-top blog-card-img" alt="{{ $blog->title }}">
                        </a>
                    @endif --}}

                    <div class="card-body d-flex flex-column">
                        {{-- Blog Title (as a link) --}}
                        <h5 class="card-title mb-2">
                            {{ $blog->title }}
                        </h5>

                        {{-- Meta Data (Date) --}}
                        <small class="text-muted mb-3 d-block"> {{-- d-block for spacing --}}
                            <i class="far fa-calendar-alt me-1"></i> {{ __('نشر في:') }} {{ $blog->created_at->format('d M, Y') }}
                            {{-- Optional Author: | <i class="far fa-user me-1"></i> {{ $blog->author->name ?? 'Admin' }} --}}
                        </small>

                        {{-- Excerpt --}}
                        <p class="card-text text-muted flex-grow-1"> {{-- flex-grow-1 pushes button down --}}
                            {{ Str::limit($blog->content, 110) }} {{-- Adjusted limit slightly --}}
                        </p>

                        {{-- Read More Button (at the bottom) --}}
                        <div class="mt-auto text-start"> {{-- Use mt-auto to push down, text-start for RTL alignment --}}
                            <a href="{{ route('blogs.details', $blog->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                {{ __('اقرأ المزيد') }} <i class="fas fa-arrow-left me-1"></i> {{-- Icon adjusted for RTL link direction --}}
                            </a>
                        </div>
                    </div> {{-- End card-body --}}
                </div> {{-- End card --}}
            </div> {{-- End col --}}
        @empty
            {{-- Message when no blogs are found --}}
            <div class="col-12">
                <div class="alert alert-secondary text-center py-4" role="alert">
                    <i class="far fa-file-alt fa-2x mb-3 text-muted"></i>
                    <h4 class="alert-heading">{{ __('لا توجد مقالات متاحة حاليًا') }}</h4>
                    <p class="mb-0">{{ __('لم يتم نشر أي مقالات بعد أو أنها لا تطابق معايير البحث. يرجى التحقق مرة أخرى قريبًا!') }}</p>
                </div>
            </div>
        @endforelse
    </div> {{-- End row --}}

    {{-- Pagination --}}
    @if ($blogs->hasPages())
        <div class="mt-5 pt-4 d-flex justify-content-center border-top">
             {{-- Append query string parameters (like filters) to pagination links --}}
            {{ $blogs->appends(request()->query())->links() }}
        </div>
    @endif

</div> {{-- End Container --}}
@endsection