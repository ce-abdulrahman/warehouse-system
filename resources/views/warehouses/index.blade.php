@extends('layouts.app')

@section('content')
    <div class="content">

        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Warehouses Management</h4>
                    <a href="{{ route('warehouses.create') }}" class="btn btn-outline-dark rounded-pill">Add Warehouse</a>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Warehouses List </li>
                    </ol>
                </div>
            </div>


            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($warehouses as $w)
                                <tr>
                                    <td>{{ $w->name }}</td>
                                    <td>{{ $w->location }}</td>
                                    <td><span
                                            class="badge {{ $w->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $w->is_active ? 'Active' : 'Inactive' }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('warehouses.edit', $w->id) }}"
                                            class="btn btn-sm btn-info">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
