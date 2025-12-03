@extends('layouts.app')

@section('content')
<div class="card col-md-8 mx-auto mt-4">
    <div class="card-header d-flex justify-content-between">
        <strong>Movement Receipt #{{ $movement->id }}</strong>
        <span>{{ $movement->created_at->format('d M Y, h:i A') }}</span>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-6">
                <h6 class="text-muted">Item Details</h6>
                <h4>{{ $movement->item->name }}</h4>
                <p>SKU: {{ $movement->item->sku }}</p>
            </div>
            <div class="col-6 text-end">
                <h6 class="text-muted">Warehouse</h6>
                <h4>{{ $movement->warehouse->name }}</h4>
                <p>{{ $movement->warehouse->location }}</p>
            </div>
        </div>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Description</th>
                    <th class="text-center">Previous Stock</th>
                    <th class="text-center">Quantity Moved</th>
                    <th class="text-center">New Stock</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        {{ $movement->type == 'in' ? 'Stock Received (IN)' : 'Stock Dispatched (OUT)' }}
                        @if($movement->notes)
                            <br><small class="text-muted">Note: {{ $movement->notes }}</small>
                        @endif
                    </td>
                    <td class="text-center">{{ $movement->before_stock }}</td>
                    <td class="text-center fw-bold {{ $movement->type == 'in' ? 'text-success' : 'text-danger' }}">
                        {{ $movement->type == 'in' ? '+' : '-' }}{{ $movement->quantity }}
                    </td>
                    <td class="text-center fw-bold">{{ $movement->after_stock }}</td>
                </tr>
            </tbody>
        </table>

        <div class="mt-4 text-end">
            <p class="text-muted">Processed by: {{ $movement->user->name }}</p>
            <a href="{{ route('movements.index') }}" class="btn btn-secondary no-print">Back to History</a>
            <button onclick="window.print()" class="btn btn-primary no-print">🖨 Print Receipt</button>
        </div>
    </div>
</div>

<style>
    @media print {
        .no-print { display: none !important; }
        .card { border: none !important; }
        #sidebar-wrapper { display: none !important; }
    }
</style>
@endsection
