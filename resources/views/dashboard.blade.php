@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Dashboard</h2>

    <div class="row">
        <!-- Items Count -->
        <div class="col-md-3">
            <div class="card stat-card bg-primary text-white mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Items</h5>
                    <p class="display-6">{{ \App\Models\Item::count() }}</p>
                </div>
            </div>
        </div>

        <!-- Total Stock -->
        <div class="col-md-3">
            <div class="card stat-card bg-success text-white mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Stock</h5>
                    <p class="display-6">{{ \App\Models\Item::sum('stock') }}</p>
                </div>
            </div>
        </div>

        <!-- Warehouses -->
        <div class="col-md-3">
            <div class="card stat-card bg-info text-white mb-3">
                <div class="card-body">
                    <h5 class="card-title">Warehouses</h5>
                    <p class="display-6">{{ \App\Models\Warehouse::count() }}</p>
                </div>
            </div>
        </div>

        <!-- Recent Movements -->
        <div class="col-md-3">
            <div class="card stat-card bg-warning text-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">Movements Today</h5>
                    <p class="display-6">{{ \App\Models\StockMovement::whereDate('created_at', today())->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quick Actions</div>
                <div class="card-body">
                    <a href="{{ route('movements.create') }}" class="btn btn-success btn-lg me-2">➕ New Stock Movement</a>
                    <a href="{{ route('items.create') }}" class="btn btn-outline-primary btn-lg">📦 Add Item</a>
                </div>
            </div>
        </div>
    </div>
@endsection
