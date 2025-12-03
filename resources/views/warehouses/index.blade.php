@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Warehouses Management</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Warehouses Management</li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="{{ route('warehouses.create') }}" class="btn btn-outline-dark rounded-pill">Add Warehouse</a>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <table class="table table-hover searchable-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($warehouses as $w)
                        <tr>
                            <td>{{ $w->name }}</td>
                            <td>{{ $w->location }}</td>
                            <td><span
                                    class="badge {{ $w->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $w->is_active ? 'Active' : 'Inactive' }}</span>
                            </td>
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
