@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Warehouses Management</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('warehouses.index') }}">Warehouses Management</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Warehouse</li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="{{ route('warehouses.index') }}" class="btn btn-outline-dark rounded-pill">Back</a>
            </div>
        </div>
    </div>

    <div class="card col-md-6 mx-auto">
        <div class="card-header">Edit Warehouse</div>
        <div class="card-body">
            <form action="{{ route('warehouses.update', $warehouse->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label>Warehouse Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $warehouse->name }}" required>
                </div>
                <div class="mb-3">
                    <label>Location</label>
                    <input type="text" name="location" class="form-control" value="{{ $warehouse->location }}">
                </div>
                <div class="mb-3">
                    <label>Contact Number</label>
                    <input type="text" name="contact_number" class="form-control"
                        value="{{ $warehouse->contact_number }}">
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="is_active" class="form-control">
                        <option value="1" {{ $warehouse->is_active ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$warehouse->is_active ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Warehouse</button>
            </form>
        </div>
    </div>
@endsection
