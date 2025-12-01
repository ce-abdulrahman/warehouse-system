

@extends('layouts.app')

@section('title', 'Item Details')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Item Details</h1>
        <div>
            <a href="{{ route('items.edit', 1) }}" class="btn btn-secondary">
                <i class="bi bi-pencil me-2"></i>Edit
            </a>
            <a href="{{ route('items.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to Items
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Item Information Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Basic Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">Item Name:</th>
                                    <td>{{ $item->name }}</td>
                                </tr>
                                <tr>
                                    <th>SKU:</th>
                                    <td>{{ $item->sku }}</td>
                                </tr>
                                <tr>
                                    <th>Category:</th>
                                    <td>{{ $item->category }}</td>
                                </tr>
                                <tr>
                                    <th>Price:</th>
                                    <td>{{ $item->price }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">Current Stock:</th>
                                    <td>{{ $item->current_stock }} units</td>
                                </tr>
                                <tr>
                                    <th>Min Stock Level:</th>
                                    <td>{{ $item->min_stock_level }} units</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td><span class="badge bg-success">{{ $item->status }}</span></td>
                                </tr>
                                <tr>
                                    <th>Primary Supplier:</th>
                                    <td>{{ $item->supplier->name ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="mt-3">
                        <h6>Description:</h6>
                        <p class="text-muted">{{ $item->description }}</p>
                    </div>
                </div>
            </div>

            <!-- Stock History -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Stock Movements</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Qty</th>
                    <th>Warehouse</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @foreach($item->movements()->latest()->take(10)->get() as $move)
                <tr>
                    <td>{{ $move->created_at->format('Y-m-d H:i') }}</td>
                    <td><span class="badge {{ $move->type == 'in' ? 'bg-success' : 'bg-danger' }}">{{ strtoupper($move->type) }}</span></td>
                    <td>{{ $move->quantity }}</td>
                    <td>{{ $move->warehouse->name }}</td>
                    <td>{{ $move->after_stock }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary">
                            <i class="bi bi-arrow-down-circle me-2"></i>Stock In
                        </button>
                        <button class="btn btn-outline-warning">
                            <i class="bi bi-arrow-up-circle me-2"></i>Stock Out
                        </button>
                        <button class="btn btn-outline-info">
                            <i class="bi bi-graph-up me-2"></i>View Report
                        </button>
                    </div>
                </div>
            </div>

            <!-- Stock Alert -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Stock Status</h5>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <div class="mb-3">
                            <span class="h2 text-primary">{{ $item->current_stock }}</span>
                            <span class="text-muted">/ {{ $item->min_stock_level }} units</span>
                        </div>
                        <div class="progress mb-3" style="height: 20px;">
                            <div class="progress-bar bg-success" style="width: 30%;">30%</div>
                        </div>
                        <p class="text-success">
                            <i class="bi bi-check-circle me-2"></i>Stock level is good
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
