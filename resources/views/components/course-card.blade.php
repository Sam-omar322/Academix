<div class="card h-100 shadow-sm">
    <img src="{{ $course->thumbnail ?? 'https://media.istockphoto.com/id/1409329028/vector/no-picture-available-placeholder-thumbnail-icon-illustration-design.jpg?s=612x612&w=0&k=20&c=_zOuJu755g2eEUioiOUdz_mHKJQJn-tDgIAhQzyeKUQ=' }}" class="card-img-top" alt="{{ $course->title }}">
    <div class="card-body d-flex flex-column">
        <h5 class="card-title">{{ $course->title }}</h5>
        <p class="card-text">{{ Str::limit($course->description, 100) }}</p>
        <div class="mt-auto d-flex justify-content-between align-items-center">
            <span class="text-primary fw-bold">{{ $course->price }} {{ __('ر.س') }}</span>
            <a href="{{ route('courses.details', $course) }}" class="btn btn-sm btn-outline-primary">{{ __('عرض التفاصيل') }}</a>
        </div>
    </div>
</div>
