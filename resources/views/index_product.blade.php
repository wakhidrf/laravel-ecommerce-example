@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Products') }}</div>

                    <div class="card-group m-auto">
                        @foreach ($products as $product)
                        <div class="col-md-4">
                            <div class="card m-2">
                                <img class="card-img-top" src="{{ url('storage/' . $product->image) }}"
                                    alt="Card image cap" height="150rem">
                                <div class="card-body">
                                    <p class="card-text">{{ $product->name }}</p>
                                    <form action="{{ route('detail_product', $product) }}" method="get">
                                        <button type="submit" class="btn btn-primary">Show Detail</button>
                                    </form>
                                    @if (Auth::check() && Auth::user()->is_admin)
                                        <form action="{{ route('delete_product', $product) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger mt-2">Delete Product</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
