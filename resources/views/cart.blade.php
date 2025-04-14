@extends('layouts.main')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div id="success" style="display: none;" class="col-md-8 text-center h4 p-4 bg-success text-light rounded">
            Purchase completed successfully!
        </div>

        @if(session('message'))
            <div class="col-md-8 text-center h4 p-4 bg-success text-light rounded">
                {{ session('message') }}
            </div> 
        @endif

        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center h5">
                    Shopping Cart
                </div>

                <div class="card-body">
                    @if($items->count())

                    <table class="table table-bordered table-hover text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Thumbnail</th>
                                <th scope="col">Title</th>
                                <th scope="col">Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        @php $totalPrice = 0; @endphp
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>
                                    <img src="{{ asset($item->thumbnail) }}" alt="Thumbnail" width="60" height="60" class="rounded">
                                </td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    {{ number_format($item->pivot->price_at_purchase, 2) }} $
                                    @php $totalPrice += $item->pivot->price_at_purchase; @endphp
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <form method="post" action="{{ route('cart.remove_one', $item->id) }}">
                                            @csrf
                                            <button class="btn btn-danger btn-sm mx-1" type="submit">
                                                <i class="fas fa-trash"></i> Remove
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <h4 class="text-center mt-4">
                        Total Amount: <span class="text-success">{{ number_format($totalPrice, 2) }} $</span>
                    </h4>

                    <div class="d-flex justify-content-between align-items-start mt-4">
                        <a href="{{ route('credit.checkout') }}" class="btn btn-primary ms-3">
                            <i class="fas fa-credit-card"></i> Pay with Credit Card
                        </a>
                    </div>

                    @else
                        <div class="alert alert-info text-center">
                            No courses in the cart.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
