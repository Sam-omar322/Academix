@extends('layouts.main')

@section('title', __('جميع الدورات'))

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">{{ __('جميع الدورات') }}</h2>

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

    <div class="mt-4 d-flex justify-content-center">
        {{ $courses->links() }}
    </div>
</div>
@endsection