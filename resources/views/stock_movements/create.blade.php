@extends('layouts.app')

@section('title', 'Add New Movement')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Movements Management</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('stock_movements.index') }}">Movements Management</a>
                    </li>
                    <li class="breadcrumb-item active">Add Movement</li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="{{ route('stock_movements.index') }}" class="btn btn-outline-dark rounded-pill">Back</a>
            </div>
        </div>
    </div>


    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Item Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('stock_movements.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label>Item</label>
                            <select name="item_id" class="form-select">
                                <option value="">Select For Item</option>
                                @foreach ($items as $i)
                                    <option value="{{ $i->id }}">{{ $i->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Warehouse</label>
                            <select name="warehouse_id" class="form-select">
                                <option value="">Select For Warehouse</option>
                                @foreach ($warehouses as $w)
                                    <option value="{{ $w->id }}">{{ $w->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Movement Type</label>
                            <select name="movement_type" class="form-select">
                                <option value="IN">IN (Increase)</option>
                                <option value="OUT">OUT (Decrease)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Note</label>
                            <textarea name="note" class="form-control"></textarea>
                        </div>

                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <button class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
