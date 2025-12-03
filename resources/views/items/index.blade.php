@extends('layouts.app')

@section('title', 'Items')

@section('content')

<div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Items Management</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Items Management</li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="{{ route('items.create') }}" class="btn btn-outline-dark rounded-pill">Add Item</a>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="card mb-3">
        <div class="card-body">

            <div class="row g-3">

                {{-- Global Search --}}
                <div class="col-md-3">
                    <label class="form-label">Search</label>
                    <input type="text" id="search-items" class="form-control" placeholder="Search items...">
                </div>

                {{-- Filter by Warehouse --}}
                <div class="col-md-3">
                    <label class="form-label">Warehouse</label>
                    <select id="filter-warehouse" class="form-select">
                        <option value="">All Warehouses</option>
                        @foreach($warehouses as $w)
                            <option value="{{ $w->name }}">{{ $w->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Filter by Supplier --}}
                <div class="col-md-3">
                    <label class="form-label">Supplier</label>
                    <select id="filter-supplier" class="form-select">
                        <option value="">All Suppliers</option>
                        @foreach($suppliers as $s)
                            <option value="{{ $s->name }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Date Range Filter --}}
                <div class="col-md-3">
                    <label class="form-label">Created From</label>
                    <input type="date" id="filter-date-start" class="form-control">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Created To</label>
                    <input type="date" id="filter-date-end" class="form-control">
                </div>

            </div>

        </div>
    </div>

    {{-- DataTable --}}
    <div class="card">
        <div class="card-body">

            <table class="datatable table table-stripped mb-0" style="width:100%">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Warehouse</th>
                        <th>Supplier</th>
                        <th>Current Stock</th>
                        <th>Min Stock</th>
                        <th>Price</th>
                        <th>Created</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($items as $index => $item)
                    <tr>

                        <td>{{ ++$index }}</td>
                        <td>{{ $item->name }}</td>

                        <td>{{ $item->warehouse->name ?? '' }}</td>
                        <td>{{ $item->supplier->name ?? '' }}</td>

                        <td>{{ $item->stock }}</td>
                        <td>{{ $item->min_stock }}</td>
                        <td>{{ setting('currency') }} {{ $item->price }}</td>

                        <td>{{ $item->created_at->format('Y-m-d') }}</td>


                        <td>


                            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i data-feather="edit"></i> Edit
                            </a>

                            <form action="{{ route('items.destroy', $item->id) }}" method="POST"
                                  class="d-inline-block"
                                  onsubmit="return confirm('Are you sure?');">
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


