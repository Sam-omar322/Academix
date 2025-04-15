@extends('layouts.dashbaord.layout')

@section('title', __('لوحة التحكم'))

@section('content')
    <div class="container">
        <h2 class="mb-4">{{ __('مرحباً بك في لوحة التحكم') }}</h2>

        <div class="row g-4 justify-content-center">
            <div class="col-md-3">
                <div class="card shadow-sm border-0 text-center">
                    <div class="card-body">
                        <h5><i class="fas fa-video fa-2x text-primary mb-2"></i></h5>
                        <h3>{{ $n_of_courses }}</h3>
                        <p class="text-muted">{{ __('إجمالي الدورات') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 text-center">
                    <div class="card-body">
                        <h5><i class="fas fa-blog fa-2x text-primary mb-2"></i></h5>
                        <h3>{{ $n_of_blogs }}</h3>
                        <p class="text-muted">{{ __('إجمالي المقالات') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 text-center">
                    <div class="card-body">
                        <h5><i class="fas fa-user fa-2x text-primary mb-2"></i></h5>
                        <h3>{{ $n_of_students }}</h3>
                        <p class="text-muted">{{ __('إجمالي الطلاب') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
