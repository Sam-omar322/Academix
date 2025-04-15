@extends('layouts.dashbaord.layout')

@section('title', __('إضافة مدونة جديدة'))

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

    <form action="{{ route('blogs.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">{{ __('عنوان المدونة') }}</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">{{ __('المحتوى') }}</label>
            <textarea class="form-control" name="content" rows="5" required>{{ old('content') }}</textarea>
            @error('content')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">{{ __('نشر') }}</button>
    </form>
</div>
@endsection
