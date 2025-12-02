@extends('layouts.app')

@section('title', 'Items')

@section('content')

<div class="container-xxl">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Items List</h4>
        <a href="{{ route('items.create') }}" class="btn btn-primary">
            <i data-feather="plus"></i> Add New Item
        </a>
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

            <table id="datatable-buttons" class="table table-striped table-bordered data-table" style="width:100%">
                <thead class="table-light">
                    <tr>
                        <th>Created</th>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Warehouse</th>
                        <th>Supplier</th>
                        <th>Min Stock</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td>{{ $item->created_at->format('Y-m-d') }}</td>

                        <td>{{ $item->name }}</td>
                        <td>{{ $item->sku }}</td>

                        <td>{{ $item->warehouse->name ?? '' }}</td>
                        <td>{{ $item->supplier->name ?? '' }}</td>

                        <td>{{ $item->min_stock }}</td>

                        <td>
                            <a href="{{ route('items.show', $item->id) }}" class="btn btn-sm btn-info">
                                <i data-feather="eye"></i>
                            </a>

                            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i data-feather="edit"></i>
                            </a>

                            <form action="{{ route('items.destroy', $item->id) }}" method="POST"
                                  class="d-inline-block"
                                  onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    <i data-feather="trash"></i>
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


