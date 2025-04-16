@extends('layouts.main')

@section('title', __('سلة المشتريات'))

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">

            {{-- رسالة نجاح الجلسة --}}
            @if(session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('إغلاق') }}"></button>
                </div>
            @endif

            {{-- رسالة خطأ --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('إغلاق') }}"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h4 class="mb-0 text-center fw-bold">
                        <i class="fas fa-shopping-cart me-2 text-primary"></i>{{ __('سلة المشتريات الخاصة بك') }}
                    </h4>
                </div>

                <div class="card-body p-4">
                    @if($items->count())

                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 15%;">{{ __('العنصر') }}</th>
                                    <th class="text-start">{{ __('عنوان الدورة') }}</th>
                                    <th style="width: 15%;">{{ __('السعر') }}</th>
                                    <th style="width: 15%;">{{ __('الإجراء') }}</th>
                                </tr>
                            </thead>
                            @php $totalPrice = 0; @endphp
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>
                                        <img src="{{ $course->thumbnail ?? asset('storage/images/placeholder-course.jpg') }}" alt="{{ $item->title }}" width="80" height="50" class="img-thumbnail p-0 border-0">
                                    </td>
                                    <td class="text-start fw-medium">
                                        <a href="{{ route('courses.details', $item->id) }}" class="text-decoration-none text-dark">{{ $item->title }}</a>
                                    </td>
                                    <td class="fw-medium">
                                        {{ number_format($item->pivot->price_at_purchase, 2) }}$
                                        @php $totalPrice += $item->pivot->price_at_purchase; @endphp
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('cart.remove_one', $item->id) }}" class="d-inline">
                                            @csrf
                                            <button class="btn btn-outline-danger btn-sm border-0" type="submit" title="{{ __('إزالة العنصر') }}">
                                                <i class="fas fa-times-circle fa-lg"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- ملخص السلة والإجراءات --}}
                    <div class="row mt-4 pt-3 border-top">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <a href="{{ route('courses.showAll') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i> {{ __('متابعة التسوق') }}
                            </a>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <h4 class="mb-3">
                                {{ __('الإجمالي:') }} <span class="fw-bold text-success">{{ number_format($totalPrice, 2) }}$</span>
                            </h4>
                            <a href="{{ route('credit.checkout') }}" class="btn btn-success btn-lg rounded-pill px-4 w-100 w-md-auto">
                                <i class="fas fa-shield-alt me-2"></i> {{ __('المتابعة للدفع الآمن') }}
                            </a>
                        </div>
                    </div>

                    @else
                        {{-- رسالة السلة الفارغة --}}
                        <div class="text-center py-5">
                            <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                            <h4 class="mb-3">{{ __('سلتك فارغة حالياً.') }}</h4>
                            <p class="text-muted mb-4">{{ __('يبدو أنك لم تقم بإضافة أي دورات حتى الآن.') }}</p>
                            <a href="{{ route('courses.showAll') }}" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-search me-2"></i> {{ __('تصفح الدورات') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
