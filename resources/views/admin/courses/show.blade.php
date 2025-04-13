@extends('layouts.dashbaord.layout')

@section('title', 'تفاصيل الدورة')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">{{ $course->title }}</h2>

    <div class="row">
        <!-- الصورة المصغرة -->
        <div class="col-md-4 mb-3">
            <div class="card shadow">
                <img src="{{ asset($course->thumbnail) }}" class="card-img-top" alt="Thumbnail">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ __('الصورة المصغرة') }}</h5>
                </div>
            </div>
        </div>

        <!-- بيانات الدورة -->
        <div class="col-md-8">
            <div class="card shadow mb-3">
                <div class="card-body">
                    <h5 class="card-title"><strong>{{ __('الوصف') }}</strong></h5>
                    <p class="card-text">{{ $course->description }}</p>
                    <hr>
                    <p><strong>{{ __('السعر:') }}</strong> {{ number_format($course->price, 2) }} ريال</p>
                    <p><strong>{{ __('تاريخ الإنشاء:') }}</strong> {{ $course->created_at->format('Y-m-d H:i') }}</p>
                    <p><strong>{{ __('آخر تحديث:') }}</strong> {{ $course->updated_at->format('Y-m-d H:i') }}</p>
                </div>
            </div>

            <!-- فيديو الدورة -->
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title"><strong>{{ __('فيديو الدورة') }}</strong></h5>
                    <video width="100%" height="300" controls preload="none">
                        <source src="{{ asset($course->video_url) }}" type="video/mp4">
                        {{ __('المتصفح لا يدعم تشغيل الفيديو.') }}
                    </video>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
