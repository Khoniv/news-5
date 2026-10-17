@extends('back.layout.template')

@section('title', 'Manage Users')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <!-- Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3 mb-4 border-bottom">
        <div>
            <h1 class="h3 fw-bold mb-1" style="color: #0F172A; letter-spacing: -0.02em;">Users & Editorial Staff</h1>
            <p class="text-muted small mb-0">Manage roles, editors, credentials, and accounts.</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            @if (auth()->user()->role == 1)
                <button class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalCreate">
                    <span data-feather="user-plus"></span>
                    Register User
                </button>
            @endif
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger border-0 rounded-3 shadow-sm mb-4">
            <ul class="mb-0 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success border-0 rounded-3 shadow-sm mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table Card Container -->
    <div class="admin-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Registered</th>
                        <th class="text-end" style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                        <tr>
                            <td class="text-muted small">{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($item->name) }}&background=0F172A&color=fff&size=32" class="rounded-circle" width="32" height="32" alt="">
                                    <span class="fw-bold text-dark">{{ $item->name }}</span>
                                </div>
                            </td>
                            <td>{{ $item->email }}</td>
                            <td>
                                @if($item->role == '1')
                                    <span class="badge bg-danger">Administrator</span>
                                @else
                                    <span class="badge bg-light text-dark border">Author / Editor</span>
                                @endif
                            </td>
                            <td class="small text-muted">{{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <button class="btn btn-sm btn-light border text-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalUpdate{{ $item->id }}" title="Edit">
                                        <span data-feather="edit-2" style="width: 13px; height: 13px;"></span>
                                    </button>
                                    @if(auth()->id() != $item->id)
                                    <button class="btn btn-sm btn-light border text-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete{{ $item->id }}" title="Delete">
                                        <span data-feather="trash-2" style="width: 13px; height: 13px;"></span>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Update User -->
                        <div class="modal fade" id="modalUpdate{{ $item->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold">Update Account</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ url('users/' . $item->id) }}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Full Name</label>
                                                <input type="text" name="name" class="form-control" value="{{ old('name', $item->name) }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Email</label>
                                                <input type="email" name="email" class="form-control" value="{{ old('email', $item->email) }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">New Password (leave blank to keep)</label>
                                                <input type="password" name="password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Delete User -->
                        <div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold text-danger">Delete User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ url('users/' . $item->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <div class="modal-body">
                                            <p class="mb-0">Are you sure you want to delete user <strong>{{ $item->name }}</strong>?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Confirm Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Create User -->
    <div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Register New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('users') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
