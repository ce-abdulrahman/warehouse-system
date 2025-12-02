@extends('layouts.app')

@section('title', 'Suppliers Management')

@section('content')

    <div class="content">

        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Suppliers Management</h4>
                    <a href="{{ route('suppliers.create') }}" class="btn btn-outline-dark rounded-pill">Add Supplier</a>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Suppliers List </li>
                    </ol>
                </div>
            </div>


            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover searchable-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Items Supplied</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suppliers as $supplier)
                                    <tr>
                                        <td>{{ $supplier->name }}</td>
                                        <td>{{ $supplier->email }}</td>
                                        <td>{{ $supplier->phone }}</td>
                                        <td>{{ $supplier->items->name ?? '' }}</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td class="table-actions">
                                            <a href="{{ route('suppliers.show', $supplier->id) }}"
                                                class="btn btn-outline-info rounded-pill">Show</a>
                                            <a href="{{ route('suppliers.edit', $supplier->id) }}"
                                                class="btn btn-outline-warning rounded-pill">Edit</a>
                                            @if (auth()->id() !== $supplier->id)
                                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST"
                                                    class="d-inline" onsubmit="return confirm('Delete supplier?')">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-outline-danger rounded-pill"><i
                                                            data-feather="trash-2"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
