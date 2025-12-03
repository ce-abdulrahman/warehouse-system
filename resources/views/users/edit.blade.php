@extends('layouts.app')

@section('content')

<div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Users Management</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Users Management</a>
                    </li>
                    <li class="breadcrumb-item active">Edit User ({{ $user->name }})</li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="{{ route('users.index') }}" class="btn btn-outline-dark rounded-pill">Back</a>
            </div>
        </div>
    </div>

    <div class="card col-md-6 mx-auto">

        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="profile-img-wrap edit-img">
                    <img class="inline-block" alt="user" src="{{ $user->avatar }}">
                    <div class="fileupload btn">
                        <span class="btn-text">edit</span>
                        <input class="upload" type="file" value="" name="avatar">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Full Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>

                <div class="mb-3">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <div class="mb-3">
                    <label>Role</label>
                    <select name="role" class="form-control" required>
                        <option value="viewer" {{ $user->role == 'viewer' ? 'selected' : '' }}>Viewer</option>
                        <option value="officer" {{ $user->role == 'officer' ? 'selected' : '' }}>Officer</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <hr>
                <p class="text-muted"><small>Leave blank to keep current password</small></p>

                <div class="mb-3">
                    <label>New Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Update User</button>
            </form>
        </div>
    </div>
@endsection
