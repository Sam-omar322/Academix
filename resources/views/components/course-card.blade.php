<div class="card h-100 w-100 shadow-sm">
    <img src="{{ $course->thumbnail ?? asset('storage/images/placeholder-course.jpg') }}" class="card-img-top" alt="{{ $course->title }}">
    <div class="card-body d-flex flex-column">
        <h5 class="card-title">{{ $course->title }}</h5>
        <p class="card-text">{{ Str::limit($course->description, 100) }}</p>
        <div class="mt-auto d-flex justify-content-between align-items-center">
            <span class="text-primary fw-bold">{{ $course->price }} {{ __('ر.س') }}</span>
            <a href="{{ route('courses.details', $course) }}" class="btn btn-sm btn-outline-primary">{{ __('عرض التفاصيل') }}</a>
        </div>
    </div>
</div>
