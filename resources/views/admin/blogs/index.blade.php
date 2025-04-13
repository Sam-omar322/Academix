@extends('layouts.dashbaord.layout')

@section('title', 'Blogs')

@section('content')
<div class="container">
    <h2 class="mb-4">{{ $title }}</h2>

    <a href="{{ route('blogs.create') }}" class="btn btn-primary mb-4">Create New Blog</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#ID</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>User</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blogs as $blog)
                    <tr>
                        <td>{{ $blog->id }}</td>
                        <td><a href="{{ route('blogs.show', $blog) }}">{{ $blog->title }}</a></td>
                        <td>{{ Str::limit($blog->content, 50) }}</td>
                        <td>{{ $blog->user->name ?? 'N/A' }}</td>
                        <td>{{ $blog->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('blogs.destroy', $blog) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this blog?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
