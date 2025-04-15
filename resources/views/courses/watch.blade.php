@extends('layouts.main')

@section('title', __('مشاهدة: :courseName', ['courseName' => $course->title]))

@section('content')
<div class="container-fluid py-4 px-lg-5"> {{-- Use container-fluid for potentially wider layout --}}

    <div class="row g-4">

        {{-- Left Column: Video Player & Comments --}}
        <div class="col-lg-9">

            {{-- Course Title (Optional, could be above the row) --}}
            <h1 class="h3 fw-bold mb-4">{{ $course->title }}</h1>
            {{-- Maybe add Lesson Title --}}
            {{-- <h2 class="h5 text-muted mb-3">{{ $currentLesson->title ?? 'Lesson Video' }}</h2> --}}

            {{-- Video Player --}}
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-body p-0"> {{-- Remove padding if video fills it --}}
                    <div class="ratio ratio-16x9">
                        <video width="100%" height="300" controls preload="none">
                            <source src="{{ asset($course->video_url) }}" type="video/mp4">
                            {{ __('المتصفح لا يدعم تشغيل الفيديو.') }}
                        </video>
                    </div>
                </div>
                 {{-- Optional: Add Video Title/Description below video inside card-body --}}
                 {{-- <div class="card-body border-top">
                    <h5 class="card-title">{{ $currentLesson->title }}</h5>
                    <p class="card-text small text-muted">{{ $currentLesson->description }}</p>
                 </div> --}}
            </div>

            {{-- Comments Section --}}
            <div class="comments-section mt-5">
                <h3 class="mb-4 border-bottom pb-2"><i class="fas fa-comments me-2"></i>{{ __('التعليقات') }} ({{ $course->comments->count() }})</h3>

                @forelse ($course->comments()->latest()->get() as $comment) {{-- Order by newest first --}}
                    <div class="d-flex mb-4 pb-3 border-bottom">
                        {{-- User Avatar --}}
                        <div class="flex-shrink-0 me-3">
                            <img class="rounded-circle mx-2" width="45" height="45" src="{{ $comment->user->profile_photo_url }}" alt="{{ $comment->user->name }}" />
                        </div>
                        {{-- Comment Content --}}
                        <div class="flex-grow-1">
                            <h5 class="mt-0 mb-1 fw-bold">{{ $comment->user->name }}</h5>
                            <p class="mb-1">{{ $comment->content }}</p>
                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small> {{-- Relative time --}}
                        </div>
                    </div>
                @empty
                    <div class="alert alert-secondary text-center" role="alert">
                       <i class="fas fa-comment-slash me-1"></i> {{ __('لا توجد تعليقات حتى الآن. كن أول من يعلق!') }}
                    </div>
                @endforelse

                {{-- Comment Form --}}
                @auth
                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-body">
                         <h5 class="card-title mb-3">{{ __('أضف تعليقك') }}</h5>
                         <form action="{{ route('comments.store', $course->id) }}" method="POST">
                            @csrf
                            {{-- Optional: Add hidden field for specific lesson if comments are per lesson --}}
                            {{-- <input type="hidden" name="lesson_id" value="{{ $currentLesson->id }}"> --}}
                            <div class="mb-3">
                                <textarea name="content" class="form-control" rows="4" placeholder="{{ __('اكتب تعليقك هنا...') }}" required minlength="5"></textarea>
                                @error('content') {{-- Display validation errors --}}
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                               <i class="fas fa-paper-plane me-2"></i> {{ __('نشر التعليق') }}
                            </button>
                        </form>
                    </div>
                </div>
                @else
                    <div class="alert alert-light text-center mt-4" role="alert">
                        <i class="fas fa-sign-in-alt me-1"></i> {{ __('يرجى') }} <a href="{{ route('login') }}" class="alert-link">{{ __('تسجيل الدخول') }}</a> {{ __('أو') }} <a href="{{ route('register') }}" class="alert-link">{{ __('التسجيل') }}</a> {{ __('لتتمكن من إضافة تعليق.') }}
                    </div>
                @endauth
            </div> {{-- End Comments Section --}}

        </div> {{-- End col-lg-8 --}}

    </div> {{-- End row --}}
</div> {{-- End container-fluid --}}
@endsection
