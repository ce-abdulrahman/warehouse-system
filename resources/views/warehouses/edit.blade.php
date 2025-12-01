@extends('layouts.app')

@section('content')
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
                <input type="text" name="contact_number" class="form-control" value="{{ $warehouse->contact_number }}">
            </div>
            <div class="mb-3 form-check">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" class="form-check-input" name="is_active" value="1" {{ $warehouse->is_active ? 'checked' : '' }}>
                <label class="form-check-label">Is Active?</label>
            </div>

            <button type="submit" class="btn btn-primary">Update Warehouse</button>
        </form>
    </div>
</div>
@endsection
