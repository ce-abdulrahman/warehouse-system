@extends('layouts.app')

@section('content')
<h3>Stock Movement History</h3>

<div class="card mt-3">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Item</th>
                    <th>Type</th>
                    <th>Qty</th>
                    <th>Warehouse</th>
                    <th>User</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @foreach($movements as $m)
                <tr>
                    <td>{{ $m->created_at->format('Y-m-d H:i') }}</td>
                    <td>{{ $m->item->name }}</td>
                    <td>
                        <span class="badge {{ $m->type == 'in' ? 'bg-success' : 'bg-danger' }}">
                            {{ strtoupper($m->type) }}
                        </span>
                    </td>
                    <td class="{{ $m->type == 'in' ? 'text-success' : 'text-danger' }}">
                        {{ $m->type == 'in' ? '+' : '-' }}{{ $m->quantity }}
                    </td>
                    <td>{{ $m->warehouse->name }}</td>
                    <td>{{ $m->user->name }}</td>
                    <td>{{ $m->after_stock }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $movements->links() }}
    </div>
</div>
@endsection


@extends('layouts.app')

@section('title', 'Stock Movements')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Stock Movements</h1>
        <div>
            <a href="{{ route('movements.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>New Movement
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover searchable-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Warehouse</th>
                            <th>Reference</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2024-01-15</td>
                            <td><span class="badge bg-success">Stock In</span></td>
                            <td>Laptop Dell XPS 13</td>
                            <td>+10</td>
                            <td>Main Warehouse</td>
                            <td>PO-001</td>
                            <td class="table-actions">
                                <a href="{{ route('movements.show', 1) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                                
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
