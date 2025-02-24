@extends('layouts.app')

@section('title', 'All Books')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-4 border-0 rounded-3 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-tags me-2"></i>Genres</h5>
                </div>
                <div class="list-group list-group-flush">
                    @foreach($genres as $genre)
                        <a href="{{ route('products.genre', $genre) }}" 
                           class="list-group-item list-group-item-action">
                            {{ $genre }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="card border-0 rounded-3 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="text-muted mb-2">Total Books</h6>
                        <h4><i class="fas fa-books me-2"></i>{{ $totalBooks }}</h4>
                    </div>
                    <div class="mb-3">
                        <h6 class="text-muted mb-2">Total Inventory Value</h6>
                        <h4 class="text-success"><i class="fas fa-dollar-sign me-2"></i>{{ number_format($totalValue, 2) }}</h4>
                    </div>
                    <button type="button" class="btn btn-info text-white w-100" data-bs-toggle="modal" data-bs-target="#calculationModal">
                        <i class="fas fa-calculator me-2"></i>Show Calculation
                    </button>
                </div>
            </div>
        </div>

        <!-- Add Modal -->
        <div class="modal fade" id="calculationModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Total Inventory Value Calculation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Book Title</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-end">Stock</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($calculationDetails as $detail)
                                <tr>
                                    <td>{{ $detail['title'] }}</td>
                                    <td class="text-end">${{ number_format($detail['price'], 2) }}</td>
                                    <td class="text-end">{{ $detail['stock'] }}</td>
                                    <td class="text-end">${{ number_format($detail['subtotal'], 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-primary">
                                    <th colspan="3">Total Inventory Value:</th>
                                    <th class="text-end">${{ number_format($totalValue, 2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($products as $product)
                    <div class="col">
                        <div class="card h-100 border-0 rounded-3 shadow-sm">
                            <img src="{{ $product['image'] }}" 
                                 class="card-img-top img-fluid" 
                                 alt="{{ $product['title'] }}"
                                 style="height: 250px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title text-primary">{{ $product['title'] }}</h5>
                                <h6 class="card-subtitle mb-3"><i class="fas fa-user-pen me-2"></i>{{ $product['author'] }}</h6>
                                <p class="card-text text-muted">{{ Str::limit($product['description'], 100) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="genre-badge text-white">{{ $product['genre'] }}</span>
                                    <span class="book-price">${{ number_format($product['price'], 2) }}</span>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-0 pb-3">
                                <a href="{{ route('products.show', $product['id']) }}" 
                                   class="btn btn-outline-primary w-100">
                                   <i class="fas fa-info-circle me-2"></i>View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
