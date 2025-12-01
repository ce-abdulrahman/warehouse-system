@extends('layouts.app')

@section('content')
<div class="card col-md-6 mx-auto">
    <div class="card-header">Add New Warehouse</div>
    <div class="card-body">
        <form action="{{ route('warehouses.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Warehouse Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Location</label>
                <input type="text" name="location" class="form-control">
            </div>
            <div class="mb-3">
                <label>Contact Number</label>
                <input type="text" name="contact_number" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Save Warehouse</button>
        </form>
    </div>
</div>
@endsection
