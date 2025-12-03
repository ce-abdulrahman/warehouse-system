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
                <a href="{{ route('stock_movements.create') }}" class="btn btn-outline-dark rounded-pill">Add Movement</a>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <table class="table table-hover searchable-table">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Item</th>
                        <th>Warehouse</th>
                        <th>Type</th>
                        <th>Qty</th>
                        <th>Note</th>
                        <th>Time</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($movements as $m)
                        <tr>
                            <td>{{ $m->id }}</td>
                            <td>{{ $m->item->name }}</td>
                            <td>{{ $m->warehouse->name }}</td>
                            <td>
                                <span class="badge text-light bg-{{ $m->movement_type == 'IN' ? 'success' : 'danger' }}">{{ $m->movement_type }}</span>
                            </td>
                            <td>{{ $m->quantity }}</td>
                            <td>{{ $m->note }}</td>
                            <td>{{ $m->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('stock_movements.edit', $m->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('stock_movements.destroy', $m->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this record?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $movements->links() }}
        </div>
    </div>


@endsection
