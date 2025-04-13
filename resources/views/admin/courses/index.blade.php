@extends('layouts.dashbaord.layout')

@section('title', 'Courses')

@section('content')
    <div class="container">
        <h2 class="mb-4">{{ $title }}</h2>

        <a href="{{ route('courses.create') }}" class="btn btn-primary mb-4">Create New Course</a>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
            <thead class="table-dark">
                    <tr>
                        <th>#ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Published Date</th>
                        <th>Actions</th>
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

                            <!-- Edit Button -->
                            <td>
                                <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">
                                        <i class="fas fa-trash-alt"></i> Delete
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