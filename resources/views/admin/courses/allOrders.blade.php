@extends('layouts.Dashbaord.layout')

@section('title')
    {{ __('جميع عمليات شراء الدورات') }}
@endsection

@section('content')
<div class="row">
    <h2 class="mb-4">{{ __('جميع عمليات شراء الدورات') }}</h2>
    <div class="col-md-12">
        <table class="table table-striped table-bordered text-right" width="100%" cellspacing="0">
            <thead class="table-dark">
                <tr>
                    <th>{{ __('المشتري') }}</th>
                    <th>{{ __('الدورة') }}</th>
                    <th>{{ __('السعر') }}</th>
                    <th>{{ __('تاريخ الشراء') }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach($allCourses as $order)
                    <tr>
                        <td>{{ $order->user->name }}</td>
                        <td><a href="{{ route('courses.details', $order->course->id) }}">{{ $order->course->title }}</a></td>
                        <td>{{ $order->price_at_purchase }}$</td>
                        <td>{{ $order->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
