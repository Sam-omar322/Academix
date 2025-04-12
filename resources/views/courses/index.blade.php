@extends('layouts.main')

@section('title', __('جميع الدورات'))

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">{{ __('جميع الدورات') }}</h2>

    <div class="row g-4">
        @forelse($courses as $course)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                <img src="{{ $course->thumbnail ?? 'https://media.istockphoto.com/id/1409329028/vector/no-picture-available-placeholder-thumbnail-icon-illustration-design.jpg?s=612x612&w=0&k=20&c=_zOuJu755g2eEUioiOUdz_mHKJQJn-tDgIAhQzyeKUQ=' }}" class="card-img-top" alt="{{ $course->title }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $course->title }}</h5>
                        <p class="card-text">{{ Str::limit($course->description, 100) }}</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="text-primary fw-bold">{{ $course->price }} {{ __('ر.س') }}</span>
                            <a href="#" class="btn btn-sm btn-outline-primary">{{ __('عرض التفاصيل') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p>{{ __('لا توجد دورات متاحة حاليًا.') }}</p>
            </div>
        @endforelse
    </div>
</div>
@endsection