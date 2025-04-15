@extends('layouts.dashbaord.layout')

@section('title', __('المدونات'))

@section('content')
<div class="container">
    <h2 class="mb-4">{{ $title }}</h2>

    <a href="{{ route('blogs.create') }}" class="btn btn-primary mb-4">{{ __('إنشاء مدونة جديدة') }}</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#{{ __('المعرف') }}</th>
                    <th>{{ __('العنوان') }}</th>
                    <th>{{ __('المحتوى') }}</th>
                    <th>{{ __('المستخدم') }}</th>
                    <th>{{ __('تاريخ الإنشاء') }}</th>
                    <th>{{ __('الخيارات') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blogs as $blog)
                    <tr>
                        <td>{{ $blog->id }}</td>
                        <td><a href="{{ route('blogs.show', $blog) }}">{{ $blog->title }}</a></td>
                        <td>{{ Str::limit($blog->content, 50) }}</td>
                        <td>{{ $blog->user->name ?? __('غير متوفر') }}</td>
                        <td>{{ $blog->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-sm btn-primary">{{ __('تعديل') }}</a>
                            <form action="{{ route('blogs.destroy', $blog) }}" method="POST" style="display:inline;" onsubmit="return confirm('{{ __('هل أنت متأكد من حذف هذه المدونة؟') }}')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">{{ __('حذف') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
