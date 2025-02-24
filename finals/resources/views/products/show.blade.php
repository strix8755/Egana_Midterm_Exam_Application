@extends('layouts.app')

@section('title', $product['title'])

@section('content')
    <div class="card border-0 rounded-3 shadow">
        <div class="card-body p-4">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Books</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.genre', $product['genre']) }}">{{ $product['genre'] }}</a></li>
                    <li class="breadcrumb-item active">{{ $product['title'] }}</li>
                </ol>
            </nav>

            <h1 class="card-title text-primary mb-3">{{ $product['title'] }}</h1>
            <h6 class="card-subtitle mb-4 text-muted"><i class="fas fa-user-pen me-2"></i>{{ $product['author'] }}</h6>
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-4">
                        <img src="{{ $product['image'] }}" 
                             class="img-fluid rounded shadow-sm mb-4" 
                             alt="{{ $product['title'] }}"
                             style="max-height: 400px; width: 100%; object-fit: contain;">
                        <h5 class="text-muted mb-3">Description</h5>
                        <p class="card-text lead">{{ $product['description'] }}</p>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <h6 class="text-muted">Genre</h6>
                            <p><span class="genre-badge text-white">{{ $product['genre'] }}</span></p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-muted">Published Year</h6>
                            <p><i class="fas fa-calendar me-2"></i>{{ $product['published_year'] }}</p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-muted">ISBN</h6>
                            <p><i class="fas fa-barcode me-2"></i>{{ $product['isbn'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title text-success mb-3">${{ number_format($product['price'], 2) }}</h3>
                            <p class="card-text mb-4">
                                <i class="fas fa-box me-2"></i>
                                Stock Available: <strong>{{ $product['stock'] }}</strong>
                            </p>
                            <button class="btn btn-primary btn-lg w-100 mb-3">
                                <i class="fas fa-cart-plus me-2"></i>Add to Cart
                            </button>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-arrow-left me-2"></i>Back to All Books
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
