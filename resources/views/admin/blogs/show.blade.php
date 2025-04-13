@extends('layouts.dashbaord.layout')

@section('title', $blog->title)

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">{{ $blog->title }}</h2>

    <div class="row">
        <!-- Blog Content -->
        <div class="col-md-8">
            <div class="card shadow mb-3">
                <div class="card-body">
                    <h5 class="card-title"><strong>{{ __('Content') }}</strong></h5>
                    <p class="card-text">{{ $blog->content }}</p>
                    <hr>
                    <p><strong>{{ __('Created At:') }}</strong> {{ $blog->created_at->format('Y-m-d H:i') }}</p>
                    <p><strong>{{ __('Updated At:') }}</strong> {{ $blog->updated_at->format('Y-m-d H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
