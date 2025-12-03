@extends('layouts.app')

@section('title', 'Edit Item')

@section('content')
<div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Items Management</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('items.index') }}">Items Management</a></li>
                    <li class="breadcrumb-item active">Edit Item</li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="{{ route('items.index') }}" class="btn btn-outline-dark rounded-pill">Back</a>
            </div>
        </div>
    </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    
                    <div class="card-body">
                        <form action="{{ route('items.update', $item->id) }}" method="POST" class="needs-validation"
                            novalidate>
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Item Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $item->name }}"
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Stock</label>
                                    <input type="number" name="stock" class="form-control" value="{{ $item->stock }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Minimum Stock</label>
                                    <input type="number" name="min_stock" class="form-control" value="{{ $item->min_stock }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Price</label>
                                    <input type="number" name="price" class="form-control" value="{{ $item->price }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Unit</label>
                                    <select name="unit" class="form-control">
                                        <option value="">Select Unit</option>
                                        <option value="pcs" {{ $item->unit == 'pcs' ? 'selected' : '' }}>pcs</option>
                                        <option value="kg" {{ $item->unit == 'kg' ? 'selected' : '' }}>kg</option>
                                        <option value="liters" {{ $item->unit == 'liters' ? 'selected' : '' }}>liters</option>
                                        <option value="boxes" {{ $item->unit == 'boxes' ? 'selected' : '' }}>boxes</option>
                                    </select>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label>Supplier</label>
                                    <select name="supplier_id" class="form-control">
                                        <option value="">Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}" {{ $item->supplier_id == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Warehouse</label>
                                    <select name="warehouse_id" class="form-control">
                                        <option value="">Select Warehouse</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}" {{ $item->warehouse_id == $warehouse->id ? 'selected' : '' }}>{{ $warehouse->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="3">{{ $item->description }}</textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Item</button>
                            <a href="{{ route('items.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
