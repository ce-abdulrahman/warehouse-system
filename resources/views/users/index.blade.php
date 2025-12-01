@extends('layouts.app')

@section('content')
    <div class="content">

        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Users</h4>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('users.create') }}" class="btn btn-outline-dark rounded-pill">Create User</a>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <span
                                                    class="badge rounded-pill text-bg-dark {{ $user->role == 'admin' ? 'bg-danger' : 'bg-primary' }}">
                                                    {{ ucfirst($user->role) }}
                                                </span>
                                            </td>
                                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('users.show', $user->id) }}"
                                                    class="btn btn-outline-info rounded-pill">Show</a>
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="btn btn-outline-warning rounded-pill">Edit</a>
                                                @if (auth()->id() !== $user->id)
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                        class="d-inline" onsubmit="return confirm('Delete user?')">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-outline-danger rounded-pill"><i data-feather="trash-2"></i></button>
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
    </div>
@endsection
