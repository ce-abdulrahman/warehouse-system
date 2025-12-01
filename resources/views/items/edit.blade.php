@extends('layouts.app')

@section('title', 'Edit Item')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Edit Item</h1>
            <a href="{{ route('items.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to Items
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Edit Item Information</h5>
                    </div>
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
                                    <label>SKU</label>
                                    <input type="text" name="sku" class="form-control" value="{{ $item->sku }}"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Supplier</label>
                                    <select name="supplier_id" class="form-control">
                                        <option value="">Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}"
                                                {{ $item->supplier_id == $supplier->id ? 'selected' : '' }}>
                                                {{ $supplier->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Unit</label>
                                    <input type="text" name="unit" class="form-control" value="{{ $item->unit }}"
                                        required>
                                </div>
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
