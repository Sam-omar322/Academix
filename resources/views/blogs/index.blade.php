@extends('layouts.main')

@section('title', __('جميع المقالات'))
@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">{{ __('جميع المقالات') }}</h1>

    <div class="row g-4">
        @foreach($blogs as $blog)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($blog->content, 100) }}</p>
                        <a href="{{ route('blogs.show', $blog->id) }}" class="mt-auto btn btn-outline-primary btn-sm">{{ __('اقرأ المزيد') }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- ترقيم الصفحات -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $blogs->links() }}
    </div>
</div>
@endsection
