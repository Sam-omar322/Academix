@extends('layouts.dashbaord.layout')

@section('title', 'إضافة دورة جديدة')

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

    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">{{ __('عنوان الدورة') }}</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required>
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">{{ __('وصف الدورة') }}</label>
            <textarea class="form-control" name="description" id="description" rows="3" required>{{ old('description') }}</textarea>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">{{ __('سعر الدورة') }}</label>
            <input type="number" class="form-control" name="price" id="price" max="999999.99" step="0.01" value="{{ old('price') }}" required>
            @error('price')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="video" class="form-label">{{ __('رفع فيديو الدورة') }}</label>
            <input type="file" class="form-control" name="video_url" id="video" accept="video/*" required>
            @error('video_url')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="thumbnail" class="form-label">{{ __('صورة الدورة (thumbnail)') }}</label>
            <input type="file" class="form-control" name="thumbnail" id="thumbnail" required>
            @error('thumbnail')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">{{ __('حفظ الدورة') }}</button>
    </form>
</div>
@endsection
