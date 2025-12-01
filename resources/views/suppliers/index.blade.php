@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Suppliers</h3>
    <a href="{{ route('suppliers.create') }}" class="btn btn-primary">Add Supplier</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($suppliers as $s)
                <tr>
                    <td>{{ $s->name }}</td>
                    <td>{{ $s->email }}</td>
                    <td>{{ $s->phone }}</td>
                    <td>
                        <a href="{{ route('suppliers.edit', $s->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('suppliers.destroy', $s->id) }}" method="POST" class="d-inline delete-form">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $suppliers->links() }}
    </div>
</div>
@endsection



@extends('layouts.app')

@section('title', 'Suppliers Management')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Suppliers Management</h1>
        <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New Supplier
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover searchable-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Items Supplied</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Supplier A</td>
                            <td>John Doe</td>
                            <td>john@suppliera.com</td>
                            <td>+1-555-0101</td>
                            <td>15</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td class="table-actions">
                                <a href="{{ route('suppliers.show', 1) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('suppliers.edit', 1) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="{{ route('suppliers.destroy', 1) }}" class="btn btn-sm btn-outline-danger delete-btn" data-item-name="Supplier A">
                                    <i class="bi bi-trash"></i>
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
