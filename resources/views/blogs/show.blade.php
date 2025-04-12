@extends('layouts.main')
@section('title', $blog->title)

@section('content')
<div class="container py-5">
    <h1 class="mb-4">{{ $blog->title }}</h1>
    <p class="text-muted">{{ $blog->created_at->format('Y-m-d') }}</p>
    <div class="mt-4">
        {!! nl2br(e($blog->content)) !!}
    </div>
</div>
@endsection