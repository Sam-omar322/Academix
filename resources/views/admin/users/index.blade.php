@extends('layouts.dashbaord.layout')

@section('title', __('المستخدمين'))

@section('content')
    <div class="container">
        <h2 class="mb-4">{{ $title }}</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#{{ __('المعرف') }}</th>
                        <th>{{ __('الاسم') }}</th>
                        <th>{{ __('البريد الإلكتروني') }}</th>
                        <th>{{ __('الدور') }}</th>
                        <th>{{ __('الخيارات') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst(__($user->role)) }}</td>
                            <td>
                                @if ($user->isAdmin())
                                    <div class="btn btn-sm btn-danger disabled">
                                        <i class="fas fa-trash-alt"></i> {{ __('حذف') }}
                                    </div>
                                @else
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('{{ __('هل أنت متأكد أنك تريد حذف هذا المستخدم؟') }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">
                                        <i class="fas fa-trash-alt"></i> {{ __('حذف') }}
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
