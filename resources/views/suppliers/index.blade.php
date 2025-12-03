@extends('layouts.app')

@section('title', 'Suppliers Management')

@section('content')

    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Suppliers Management</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Suppliers Management</li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="{{ route('suppliers.create') }}" class="btn btn-outline-dark rounded-pill">Add Supplier</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover searchable-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>

                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suppliers as $supplier)
                            <tr>
                                <td>{{ $supplier->name }}</td>
                                <td>{{ $supplier->email }}</td>
                                <td>{{ $supplier->phone }}</td>

                                <td><span class="badge bg-success">Active</span></td>
                                <td>


                                    <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-sm btn-warning">
                                        <i data-feather="edit"></i> Edit
                                    </a>

                                    <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i data-feather="trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
