@extends('layouts.dashbaord.layout')

@section('title', __('الدورات'))

@section('content')
    <div class="container">
        <h2 class="mb-4">{{ $title }}</h2>

        <a href="{{ route('courses.create') }}" class="btn btn-primary mb-4">{{ __('إضافة دورة جديدة') }}</a>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#{{ __('المعرف') }}</th>
                        <th>{{ __('العنوان') }}</th>
                        <th>{{ __('الوصف') }}</th>
                        <th>{{ __('السعر') }}</th>
                        <th>{{ __('تاريخ النشر') }}</th>
                        <th>{{ __('الخيارات') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td>{{ $course->id }}</td>
                            <td><a href="{{ route('courses.show', $course) }}">{{ $course->title }}</a></td>
                            <td>{{ $course->description ?? '-' }}</td>
                            <td>{{ $course->price ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($course->published_at)->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> {{ __('تعديل') }}
                                </a>
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('{{ __('هل أنت متأكد أنك تريد حذف هذه الدورة؟') }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">
                                        <i class="fas fa-trash-alt"></i> {{ __('حذف') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
