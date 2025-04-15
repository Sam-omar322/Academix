@extends('layouts.main')

@section('title', __('دوراتي'))

@section('content')
<div class="container py-5">

    {{-- Page Header Section --}}
    <div class="text-center mb-4 pb-3 border-bottom">
        <h1 class="display-5 fw-bold">{{ __('جميع دوراتك') }}</h1>
        <p class="lead text-muted">{{ __('استمتع بالتعلم مع دورات اكاديمكس.') }}</p>
    </div>

    {{-- Course Grid --}}
    <div class="row g-4">
        @forelse($courses as $course)
            {{-- Use more responsive columns and ensure equal height cards --}}
            <div class="col-sm-6 col-md-6 col-lg-4 d-flex align-items-stretch">
                {{-- Assuming x-course-card renders a full <div class="card h-100">...</div> structure --}}
                {{-- If not, wrap it: <div class="card h-100 shadow-sm"> <x-course-card :course="$course" /> </div> --}}
                 <x-course-card :course="$course" class="h-100"/> {{-- Pass h-100 class if component accepts attributes --}}
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-4" role="alert">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <h4 class="alert-heading">{{ __('لا توجد دورات متاحة حاليًا') }}</h4>
                    <p>{{ __('لم نجد أي دورات تطابق معايير البحث الحالية أو لا توجد دورات مضافة بعد.') }}</p>
                    {{-- Optional: Link back to home or reset filters --}}
                    {{-- <hr>
                    <a href="{{ route('home') }}" class="btn btn-primary btn-sm">{{ __('العودة للرئيسية') }}</a> --}}
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if ($courses->hasPages()) {{-- Only show pagination if needed --}}
        <div class="mt-5 pt-3 d-flex justify-content-center border-top">
             {{-- Append query string parameters (like filters) to pagination links --}}
            {{ $courses->appends(request()->query())->links() }}
        </div>
    @endif

</div> {{-- End Container --}}
@endsection