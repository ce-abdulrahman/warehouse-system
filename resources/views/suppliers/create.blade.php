@extends('layouts.app')

@section('content')
<div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Suppliers Management</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('suppliers.index') }}">Suppliers Management</a></li>
                    <li class="breadcrumb-item active">Add Supplier</li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="{{ route('suppliers.index') }}" class="btn btn-outline-dark rounded-pill">Back</a>
            </div>
        </div>
    </div>

<div class="card col-md-6 mx-auto">
    <div class="card-header">Add Supplier</div>
    <div class="card-body">
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control">
            </div>
            <div class="mb-3">
                <label>Address</label>
                <textarea name="address" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Save Supplier</button>
        </form>
    </div>
</div>
@endsection
