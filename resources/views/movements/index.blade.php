@extends('layouts.app')

@section('title', 'Stock Movements')

@section('content')

    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Movements Management</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Movements Management</li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="{{ route('movements.create') }}" class="btn btn-outline-dark rounded-pill">Add Movement</a>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover searchable-table">
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
                        @foreach ($movements as $m)
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
            </div>
        </div>
    </div>


@endsection
