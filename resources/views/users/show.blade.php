@extends('layouts.app')

@section('content')
    <div class="container-xxl">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Profile</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Profile</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">

                        <div class="align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="{{ auth()->user()->avatar }}"
                                    class="rounded-circle avatar-xxl img-thumbnail float-start" alt="image profile">

                                <div class="overflow-hidden ms-4">
                                    <h4 class="m-0 text-dark fs-20">{{ auth()->user()->name }}</h4>
                                    <p class="my-1 text-muted fs-16">{{ auth()->user()->email }}</p>
                                    <span class="fs-15">
                                        <span class="fs-15"><i class="mdi mdi- me-2 align-middle"></i>Role: <span
                                                class="badge bg-primary-subtle text-primary px-2 py-1 fs-13 fw-normal">{{ auth()->user()->role }}</span>
                                        </span>
                                </div>
                            </div>
                        </div>

                        <ul class="nav nav-underline border-bottom pt-2" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link p-2" id="setting_tab" data-bs-toggle="tab" href="#profile_setting"
                                    role="tab">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-school"></i></span>
                                    <span class="d-none d-sm-block">Setting</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content text-muted bg-white">

                            <div class="tab-pane pt-4" id="profile_setting" role="tabpanel">
                                <div class="row">

                                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                                        @csrf @method('PUT')

                                        <div class="row">
                                            <div class="col-lg-6 col-xl-6">
                                                <div class="card border mb-0">

                                                    <div class="card-header">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <h4 class="card-title mb-0">Personal Information</h4>
                                                            </div><!--end col-->
                                                        </div>
                                                    </div>

                                                    <div class="card-body">
                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">First Name</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input class="form-control" name="name" type="text"
                                                                    value="{{ $user->name }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Email Address</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i
                                                                            class="mdi mdi-email"></i></span>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $user->email }}" name="email" placeholder="Email"
                                                                        aria-describedby="basic-addon1" readonly>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Role</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <select name="role" id="role" class="form-select">
                                                                    <option value="admin"
                                                                        {{ $user->role == 'admin' ? 'selected' : '' }}>
                                                                        Admin</option>
                                                                    <option value="user"
                                                                        {{ $user->role == 'user' ? 'selected' : '' }}>
                                                                        User</option>
                                                                    <option value="viewer"
                                                                        {{ $user->role == 'viewer' ? 'selected' : '' }}>
                                                                        Viewer</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Image</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input class="form-control" type="file"
                                                                    value="{{ $user->avatar }}" name="avatar">
                                                            </div>
                                                        </div>

                                                    </div><!--end card-body-->
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-xl-6">
                                                <div class="card border mb-0">

                                                    <div class="card-header">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <h4 class="card-title mb-0">Change Password</h4>
                                                            </div><!--end col-->
                                                        </div>
                                                    </div>

                                                    <div class="card-body mb-0">
                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Old Password</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input class="form-control" type="password"
                                                                    placeholder="Old Password">
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">New Password</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input class="form-control" name="password"
                                                                    type="password" placeholder="New Password">
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Confirm Password</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input class="form-control" name="password_confirmation"
                                                                    type="password" placeholder="Confirm Password">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-lg-12 col-xl-12">
                                                                <button type="submit" class="btn btn-primary">Change
                                                                    Password</button>
                                                                <button type="button"
                                                                    class="btn btn-danger">Cancel</button>
                                                            </div>
                                                        </div>

                                                    </div><!--end card-body-->
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div> <!-- end education -->

                        </div> <!-- Tab panes -->
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
