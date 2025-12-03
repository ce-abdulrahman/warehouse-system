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
                    <li class="breadcrumb-item active">Create User</li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="{{ route('users.index') }}" class="btn btn-outline-dark rounded-pill">Back</a>
            </div>
        </div>
    </div>


    <div class="card col-md-6 mx-auto">

        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="profile-img-wrap edit-img">
                    <img class="inline-block" alt="user">
                    <div class="fileupload btn">
                        <span class="btn-text">edit</span>
                        <input class="upload" type="file" name="avatar">
                    </div>
                </div>
                <div class="mb-3">
                    <label>Full Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Role</label>
                    <select name="role" class="form-control" required>
                        <option value="admin">Admin</option>
                        <option value="officer">Officer</option>
                        <option value="viewer">Viewer</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Create User</button>
            </form>
        </div>
    </div>
@endsection
