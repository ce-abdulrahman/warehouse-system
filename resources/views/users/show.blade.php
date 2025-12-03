@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Profile</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ul>
            </div>
        </div>
        </div>

        <div class="card mb-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-view">
                            <div class="profile-img-wrap">
                                <div class="profile-img">
                                    <a href="#"><img alt="" src="{{ auth()->user()->avatar }}"></a>
                                </div>
                            </div>
                            <div class="profile-basic">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="profile-info-left">
                                            <h3 class="user-name m-t-0 mb-0">{{ auth()->user()->name }}</h3>
                                            <h6 class="text-muted">{{ auth()->user()->role }}</h6>

                                            <div class="small doj text-muted">{{ auth()->user()->email }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <ul class="personal-info">
                                            <li>
                                                <div class="title">Name:</div>
                                                <div class="text">{{ auth()->user()->name }}</div>
                                            </li>
                                            <li>
                                                <div class="title">Email:</div>
                                                <div class="text"><a href="mailto:{{ auth()->user()->email }}">{{ auth()->user()->email }}</a></div>
                                            </li>
                                            <li>
                                                <div class="title">Role:</div>
                                                <div class="text ">{{ auth()->user()->role }}</div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon"
                                    href="#"><i class="fa fa-pencil"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Modal -->
        <div id="profile_info" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Profile Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="profile-img-wrap edit-img">
                                        <img class="inline-block" src="{{ $user->avatar }}" alt="user">
                                        <div class="fileupload btn">
                                            <span class="btn-text">edit</span>
                                            <input class="upload" type="file" name="image">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ $user->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" value="{{ $user->email }}">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Role <span class="text-danger">*</span></label>
                                        <select name="role" id="role" class="select">
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                                                Admin</option>
                                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>
                                                User</option>
                                            <option value="viewer" {{ $user->role == 'viewer' ? 'selected' : '' }}>
                                                Viewer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Profile Modal -->
    </div>
@endsection
