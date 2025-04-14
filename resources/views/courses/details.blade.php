@extends('layouts.main')

@section('title', __('تفاصيل الدورة: :courseName', ['courseName' => $course->name]))

@section('content')
<div class="container py-5">

    <!-- عنوان الدورة -->
    <h1 class="mb-3">{{ __($course->title) }}</h1>
    
    <!-- وصف الدورة -->
    <p class="lead">{{ __($course->description) }}</p>

    <!-- الفيديو -->
    <div class="ratio ratio-16x9 mb-4">
        <video width="100%" height="300" controls preload="none">
            <source src="{{ asset($course->video_url) }}" type="video/mp4">
            {{ __('المتصفح لا يدعم تشغيل الفيديو.') }}
        </video>
    </div>

    <!-- سعر الدورة -->
    <div class="mb-5 d-flex align-items-center gap-3">
        <h5>
            <strong>{{ __('السعر') }}:</strong> {{ $course->price }}$
        </h5>
        <button class="btn btn-dark rounded-3"></button>
        @auth
            <div class="form">
                <input id="CourseId" type="hidden" value="{{ $course->id }}">
                <button type="submit" class="btn btn-primary w-100 addCart">
                    <i class="fas fa-cart-plus me-1"></i> {{ __('شراء الآن') }}
                </button>
            </div>
        @endauth
    </div>

</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('.addCart').on('click', function (event) {
            event.preventDefault();

            var token = '{{ csrf_token() }}';
            var url = "{{ route('cart.add') }}";
            var courseId = $(this).parents(".form").find("#CourseId").val()

            $.ajax({
                method: 'POST',
                url: url,
                data: {
                    id: courseId,
                    _token: token
                },
                success: function (data) {
                    if (data.already_added) {
                        alert(data.message); // e.g. "You have already added this course to your cart."
                    } else {
                        $('span.badge').text(data.num_of_product); // update cart count
                        alert(data.message); // e.g. "Course added to cart successfully."
                    }
                },
                error: function () {
                    alert('Something went wrong! Please try again.');
                }
            });
        });
    });
</script>
@endsection