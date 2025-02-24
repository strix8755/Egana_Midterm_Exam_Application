@extends('layouts.app')

@section('title', $genre . ' Books')

@section('content')
    <h1>{{ $genre }} Books</h1>
    
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
        @foreach($products as $product)
            <div class="col">
                <div class="card h-100 border-0 rounded-3 shadow-sm">
                    <img src="{{ $product['image'] }}" 
                         class="card-img-top img-fluid" 
                         alt="{{ $product['title'] }}"
                         style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product['title'] }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $product['author'] }}</h6>
                        <p class="card-text">{{ Str::limit($product['description'], 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-success">${{ number_format($product['price'], 2) }}</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('products.show', $product['id']) }}" 
                           class="btn btn-sm btn-outline-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
            Back to All Books
        </a>
    </div>
@endsection
