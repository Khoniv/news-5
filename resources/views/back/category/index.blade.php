@extends('back.layout.template')

@section('title', 'Categories')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <!-- Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3 mb-4 border-bottom">
        <div>
            <h1 class="h3 fw-bold mb-1" style="color: #0F172A; letter-spacing: -0.02em;">Categories</h1>
            <p class="text-muted small mb-0">Organize articles and dispatches by journalistic topics.</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalCreate">
                <span data-feather="plus-circle"></span>
                Add Category
            </button>
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
                        <th>Category Name</th>
                        <th>URL Slug</th>
                        <th>Created At</th>
                        <th class="text-end" style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $item)
                        <tr>
                            <td class="text-muted small">{{ $loop->iteration }}</td>
                            <td>
                                <span class="fw-bold text-dark">{{ $item->name }}</span>
                            </td>
                            <td>
                                <code class="px-2 py-1 bg-light rounded text-dark" style="font-size: 12px;">{{ $item->slug }}</code>
                            </td>
                            <td class="small text-muted">{{ $item->created_at ? $item->created_at->format('d M Y, H:i') : '-' }}</td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <button class="btn btn-sm btn-light border text-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalUpdate{{ $item->id }}" title="Edit">
                                        <span data-feather="edit-2" style="width: 13px; height: 13px;"></span>
                                    </button>
                                    <button class="btn btn-sm btn-light border text-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete{{ $item->id }}" title="Delete">
                                        <span data-feather="trash-2" style="width: 13px; height: 13px;"></span>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Update -->
                        <div class="modal fade" id="modalUpdate{{ $item->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold">Update Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ url('categories/' . $item->id) }}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="name" class="form-label fw-semibold">Category Name</label>
                                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $item->name) }}">
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

                        <!-- Modal Delete -->
                        <div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold text-danger">Delete Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ url('categories/' . $item->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <div class="modal-body">
                                            <p class="mb-0">Are you sure you want to delete category <strong>{{ $item->name }}</strong>?</p>
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

    <!-- Modal Create -->
    <div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Create Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('categories') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Category Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="e.g. Robotik, Bisnis" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
