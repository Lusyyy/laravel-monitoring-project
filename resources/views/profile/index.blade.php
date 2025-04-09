@extends('layout.main')
@section('main')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Profile User</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="/dashboard">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Profile</a>
                    </li>
                </ul>
            </div>

            <form action="/profile" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">My Profile</div>
                            </div>
                            <div class="card-body">
                                <d<div class="row">
                                    <!-- Form pertama -->
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Name" value="{{ auth()->user()->name }}" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="contact">Contact</label>
                                            <input type="text" class="form-control" id="contact" name="contact"
                                                placeholder="Contact" value="{{ auth()->user()->contact }}" required />
                                        </div>

                                    </div>

                                    <!-- Form kedua sejajar dengan form pertama -->
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" placeholder="Email"
                                                value="{{ auth()->user()->email }}" required />
                                            @error('email')
                                                <div class="feedback">
                                                    <div class="invalid-feedback"></div>
                                                    <small class="text-danger"
                                                        style="font-size: 11px">{{ $message }}</small>
                                                </div>
                                                <br>
                                            @enderror
                                        </div>
                                       
                                    </div>
                            </div>
                        </div>
                        <div class="card-action d-flex justify-content-end">
                            <button class="btn btn-primary me-2" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal fade" id="changepassword" type="button" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">
                            <span class="fw-mediumbold">Change Password</span>
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>Old Password</label>
                                        <input id="addProjectName" name="name" type="password" class="form-control"
                                            placeholder="" required />
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="form-group form-group-default">
                                        <label>New Password</label>
                                        <input id="addProjectDesc" name="description" type="password" class="form-control"
                                            placeholder="" required />
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="form-group form-group-default">
                                        <label>Confirm New Password</label>
                                        <input id="addProjectDesc" name="description" type="password" class="form-control"
                                            placeholder="" required />
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
