@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Users Management</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Users
                    </li>

                </ul>
            </div>
            <div class="col-auto">
                <a href="{{ route('users.create') }}" class="btn btn-outline-dark rounded-pill">Add</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <table id="datatable-buttons" class="table table-hover searchable-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td><img src="{{ $user->avatar }}" alt="" srcset="" class="img-thumbnail"
                                            style="width: 50px; height: 50px;"></td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span
                                            class="badge rounded-pill text-light {{ $user->role == 'admin' ? 'bg-success' : ($user->role == 'viewer' ? 'bg-primary' : 'bg-info') }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
