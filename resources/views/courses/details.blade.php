@extends('layouts.main')

@section('title', __('تفاصيل الدورة: :courseName', ['courseName' => $course->name]))

@section('content')
<div class="container py-5">

    <!-- عنوان الدورة -->
    <h1 class="mb-3">{{ __($course->title) }}</h1>
    
    <!-- وصف الدورة -->
    <p class="lead">{{ __($course->description) }}</p>

    <!-- سعر الدورة -->
    <div class="mb-5 d-flex align-items-center gap-3">
        <h5>
            <strong>{{ __('السعر') }}:</strong> {{ $course->price }}$
        </h5>
        @auth
            @php
                $userOwnsThisCourse = auth()->user()->myCourses()->where('course_id', $course->id)->exists();
            @endphp

            @if(!$userOwnsThisCourse)
                <div class="form">
                    <input id="CourseId" type="hidden" value="{{ $course->id }}">
                    <button type="submit" class="btn btn-dark rounded-3 addCart">
                        <i class="fas fa-cart-plus me-1"></i> {{ __('شراء الآن') }}
                    </button>
                </div>
            @else
                <div class="alert alert-success">
                    {{ __('تم شراء هذه الدورة بالفعل') }}
                    <a href="{{ route('courses.watch', $course->id) }}">{{ __('شاهد') }}</a>
                </div>
            @endif
        @endauth
            @guest
                <div class="alert alert-warning">
                    {{ __('يرجى تسجيل الدخول لشراء الدورة') }}
                </div>
            @endguest
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