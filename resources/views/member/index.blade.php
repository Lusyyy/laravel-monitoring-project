@extends('layout.main')
@section('main')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Data Members</h3>
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
                        <a href="#">Members</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">All member</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($members as $member)
                                            <tr>
                                                <td>{{ ucwords($member->name) }}</td>
                                                <td>{{ $member->email }}</td>
                                                <td>{{ $member->contact }}</td>
                                                <td>
                                                    @if ($member->id !== auth()->user()->id) 
                                                        <button class="btn btn-danger btn-sm ms-auto"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteUser{{ $member->id }}" type="button",>
                                                            Delete
                                                        </button>
                                                    @endif

                                                    @if ($member->role == 2)
                                                        <button class="btn btn-primary btn-sm ms-auto"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#makeitadmin{{ $member->id }}" type="button">
                                                            Make Admin
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                            <!-- modal ubah role ke admin -->
                                            <div class="modal fade" id="makeitadmin{{ $member->id }}" tabindex="-1"
                                                aria-labelledby="endProjectModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="endProjectModalLabel">Make Admin</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                               
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure to change his role?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-dismiss="modal">Cancel
                                                            </button>
                                                            <form action="/makeitadmin" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $member->id }}">
                                                                <button type="submit" class="btn btn-danger">Yes</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Hapus -->
                                            <div class="modal fade" id="deleteUser{{ $member->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <<div class="modal-dialog modal-sm" role="document">
                                                    <form action="{{ route('user.destroy') }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="id" value="{{ $member->id }}">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this user?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection