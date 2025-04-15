@extends('layouts.main')

@section('title', __('تفاصيل الدورة: :courseName', ['courseName' => $course->title]))

@section('content')
<div class="container py-5">
    <div class="row g-lg-5">
        <div class="col-lg-8">
            {{-- Left Column: Course Details --}}
            {{-- Course Title --}}
            <h1 class="fw-bold mb-3">{{ $course->title }}</h1>

            {{-- Course Description --}}
            <p class="lead text-muted mb-4">{{ $course->description }}</p>

            {{-- Course thumbnail --}}
            <img src="{{ $course->thumbnail ?? asset('storage/images/placeholder-course.jpg') }}" class="card-img-top mb-5" alt="{{ $course->title }}">

        </div>

        {{-- Right Column: Purchase Action & Meta --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    {{-- Price --}}
                    <p class="h3 fw-bold text-primary mb-4 text-center">{{ $course->price }}$</p>

                    {{-- Purchase Logic --}}
                    @auth
                        @php
                            // Check if the authenticated user owns this course
                            $userOwnsThisCourse = auth()->user()->myCourses()->where('course_id', $course->id)->exists();
                        @endphp

                        @if(!$userOwnsThisCourse)
                            {{-- Button to Add to Cart --}}
                            <div class="purchase-form d-grid"> {{-- d-grid makes button below full width --}}
                                <input id="CourseId" type="hidden" value="{{ $course->id }}">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill addCart">
                                    <i class="fas fa-cart-plus me-2"></i> {{ __('أضف إلى السلة') }}
                                </button>
                            </div>
                            {{-- Or use Buy Now if you have direct checkout --}}
                             {{-- <form action="{{ route('checkout.direct', $course->id) }}" method="POST" class="d-grid">
                                @csrf
                                <button type="submit" class="btn btn-success btn-lg rounded-pill">
                                    <i class="fas fa-dollar-sign me-2"></i> {{ __('شراء الآن') }}
                                </button>
                             </form> --}}

                        @else
                            {{-- Message for Owned Course --}}
                            <div class="alert alert-success text-center mb-0" role="alert">
                                <p class="mb-2"> <i class="fas fa-check-circle me-1"></i> {{ __('أنت تملك هذه الدورة بالفعل.') }}</p>
                                <a href="{{ route('courses.watch', $course->id) }}" class="btn btn-outline-success btn-sm">{{ __('شاهد الدورة') }}</a>
                            </div>
                        @endif
                    @endauth

                    @guest
                        {{-- Message for Guests --}}
                        <div class="alert alert-warning text-center mb-0" role="alert">
                            <i class="fas fa-info-circle me-1"></i> {{ __('يرجى') }}
                            <a href="{{ route('login') }}" class="alert-link">{{ __('تسجيل الدخول') }}</a>
                            {{ __('أو') }}
                            <a href="{{ route('register') }}" class="alert-link">{{ __('التسجيل') }}</a>
                            {{ __('لتتمكن من شراء الدورة.') }}
                        </div>
                    @endguest

                    {{-- Optional: Add Course Meta Data (Duration, Level, etc.) --}}
                    {{-- <hr class="my-4">
                    <ul class="list-unstyled text-muted small">
                        <li><i class="fas fa-clock me-2"></i> {{ __('المدة:') }} {{ $course->duration ?? 'N/A' }}</li>
                        <li><i class="fas fa-layer-group me-2"></i> {{ __('المستوى:') }} {{ $course->level ?? 'N/A' }}</li>
                        <li><i class="fas fa-language me-2"></i> {{ __('اللغة:') }} {{ $course->language ?? 'العربية' }}</li>
                        <li><i class="fas fa-sync-alt me-2"></i> {{ __('آخر تحديث:') }} {{ $course->updated_at->format('Y/m/d') }}</li>
                    </ul> --}}

                </div> {{-- End card-body --}}
            </div> {{-- End card --}}
        </div> {{-- End col-lg-4 --}}

    </div> {{-- End row --}}
</div> {{-- End container --}}
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('.addCart').on('click', function (event) {
            event.preventDefault();

            var token = '{{ csrf_token() }}';
            var url = "{{ route('cart.add') }}";
            var courseId = $(this).closest('.purchase-form').find('#CourseId').val();
            var $button = $(this);

            $button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> {{ __("جار الإضافة...") }}');

            $.ajax({
                method: 'POST',
                url: url,
                data: {
                    id: courseId,
                    _token: token
                },
                success: function (data) {
                    if (data.status === 'success') {
                        alert(data.message);
                        $button.removeClass('btn-primary').addClass('btn-secondary').html('<i class="fas fa-check me-2"></i> {{ __("تمت الإضافة") }}');
                    } else {
                        $('#cart-count').text(data.num_of_product);
                         alert(data.message);
                         $button.prop('disabled', false).html('<i class="fas fa-cart-plus me-2"></i> {{ __("أضف إلى السلة") }}');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("AJAX Error:", textStatus, errorThrown);
                    alert('{{ __("حدث خطأ ما! يرجى المحاولة مرة أخرى.") }}');
                     $button.prop('disabled', false).html('<i class="fas fa-cart-plus me-2"></i> {{ __("أضف إلى السلة") }}');
                }
            });
        });
    });
</script>
@endsection