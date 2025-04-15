@extends('layouts.main')

@section('title', $blog->title)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9"> {{-- Constrain width for better readability --}}

            {{-- Blog Post Header --}}
            <header class="mb-4 text-center">
                {{-- Blog Title --}}
                <h1 class="fw-bold mb-3">{{ $blog->title }}</h1>

                {{-- Meta Information (Date, Author - Optional) --}}
                <p class="text-muted blog-meta">
                    <i class="far fa-calendar-alt me-2"></i>{{ __('نشر في:') }} {{ $blog->created_at->translatedFormat('d F Y') }} {{-- Format date nicely --}}
                     {{-- Optional Author --}}
                     {{-- @if($blog->author)
                         <span class="mx-2">|</span>
                         <i class="far fa-user me-2"></i> {{ __('بواسطة:') }} {{ $blog->author->name }}
                     @endif --}}
                     {{-- Optional Category --}}
                     {{-- @if($blog->category)
                        <span class="mx-2">|</span>
                        <i class="far fa-folder-open me-2"></i> <a href="#" class="text-muted text-decoration-none">{{ $blog->category->name }}</a>
                    @endif --}}
                </p>
            </header>

            {{-- Blog Post Content --}}
            <article class="blog-content mt-4 pt-3 border-top">
                {{--
                    IMPORTANT: Use {!! !!} ONLY if you have SANITIZED the HTML content
                    before saving it to the database to prevent XSS attacks.
                    If the content is plain text, use nl2br(e($blog->content)).
                --}}
                {!! $blog->content !!}
            </article>

        </div> {{-- End col-lg-9 --}}
    </div> {{-- End row --}}
</div> {{-- End container --}}
@endsection