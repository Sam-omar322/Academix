@extends('layouts.dashbaord.layout')

@section('title', 'Edit Blog')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">{{ $title }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('blogs.update', $blog->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">{{ __('Blog Title') }}</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $blog->title }}" required>
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">{{ __('Blog Content') }}</label>
            <textarea class="form-control" name="content" id="content" rows="3" required>{{ $blog->content }}</textarea>
            @error('content')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Update Blog') }}</button>
    </form>
</div>
@endsection
