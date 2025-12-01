@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Warehouses</h3>
    <a href="{{ route('warehouses.create') }}" class="btn btn-primary">Add Warehouse</a>
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($warehouses as $w)
                <tr>
                    <td>{{ $w->name }}</td>
                    <td>{{ $w->location }}</td>
                    <td><span class="badge {{ $w->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $w->is_active ? 'Active' : 'Inactive' }}</span></td>
                    <td>
                        <a href="{{ route('warehouses.edit', $w->id) }}" class="btn btn-sm btn-info">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Warehouses Management')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Warehouses Management</h1>
        <a href="{{ route('warehouses.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New Warehouse
        </a>
    </div>

    <div class="row">
        <!-- Warehouse Cards -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title">Main Warehouse</h5>
                            <p class="text-muted">New York, USA</p>
                        </div>
                        <span class="badge bg-success">Active</span>
                    </div>
                    <div class="mt-3">
                        <small class="text-muted">Capacity: 5000 sq ft</small><br>
                        <small class="text-muted">Items: 45</small>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="btn-group w-100">
                        <a href="{{ route('warehouses.show', 1) }}" class="btn btn-sm btn-outline-primary">View</a>
                        <a href="{{ route('warehouses.edit', 1) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <a href="{{ route('warehouses.destroy', 1) }}" class="btn btn-sm btn-outline-danger delete-btn" data-item-name="Main Warehouse">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
