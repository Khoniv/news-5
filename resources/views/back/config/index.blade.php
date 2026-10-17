@extends('back.layout.template')

@section('title', 'List Config')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <!-- Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3 mb-4 border-bottom">
        <div>
            <h1 class="h3 fw-bold mb-1" style="color: #0F172A; letter-spacing: -0.02em;">Website Configurations</h1>
            <p class="text-muted small mb-0">Manage global branding, headlines, footer text, and meta values.</p>
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
                        <th style="width: 180px;">Parameter</th>
                        <th>Current Value</th>
                        <th class="text-end" style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($config as $item => $key)
                        <tr>
                            <td class="text-muted small">{{ $config->firstItem() + $item }}</td>
                            <td>
                                <code class="px-2 py-1 bg-light rounded text-dark fw-bold" style="font-size: 12px;">{{ $key->name }}</code>
                            </td>
                            <td>
                                <span class="text-secondary">{{ $key->value }}</span>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-light border text-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalUpdate{{ $key->id }}" title="Edit">
                                    <span data-feather="edit-2" style="width: 13px; height: 13px;"></span>
                                    Edit
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Update Config -->
                        <div class="modal fade" id="modalUpdate{{ $key->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold">Update Configuration</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ url('config/' . $key->id) }}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Parameter Name</label>
                                                <input type="text" name="name" class="form-control" value="{{ old('name', $key->name) }}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Value</label>
                                                <textarea name="value" class="form-control" rows="3">{{ old('value', $key->value) }}</textarea>
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
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $config->links() }}
        </div>
    </div>
</main>
@endsection
