@extends('layouts.app')

@section('content')
<div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Suppliers Management</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('suppliers.index') }}">Suppliers Management</a></li>
                    <li class="breadcrumb-item active">Edit Supplier</li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="{{ route('suppliers.index') }}" class="btn btn-outline-dark rounded-pill">Back</a>
            </div>
        </div>
    </div>


<div class="card col-md-6 mx-auto">
    <div class="card-header">Edit Supplier</div>
    <div class="card-body">
        <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ $supplier->name }}" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $supplier->email }}">
            </div>
            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ $supplier->phone }}">
            </div>
            <div class="mb-3">
                <label>Address</label>
                <textarea name="address" class="form-control">{{ $supplier->address }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Supplier</button>
        </form>
    </div>
</div>
@endsection
