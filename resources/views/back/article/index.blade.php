@extends('back.layout.template')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
@endpush

@section('title', 'Manage Articles')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <!-- Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3 mb-4 border-bottom">
        <div>
            <h1 class="h3 fw-bold mb-1" style="color: #0F172A; letter-spacing: -0.02em;">News5 Articles</h1>
            <p class="text-muted small mb-0">Publish, organize, draft, and modify publication stories.</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ url('article/create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                <span data-feather="plus-circle"></span>
                Create Article
            </a>
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

    <div class="swal" data-swal="{{ session('success') }}"></div>

    <!-- Table Container Card -->
    <div class="admin-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="dataTable">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Headline</th>
                        <th>Category</th>
                        <th>Views</th>
                        <th>Status</th>
                        <th>Publish Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $item)
                    <tr>
                        <td class="text-muted small">{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="{{ asset('storage/back/' . $item->img) }}" class="rounded" width="44" height="32" style="object-fit: cover;" alt="">
                                <div class="fw-semibold text-truncate" style="max-width: 280px;" title="{{ $item->title }}">
                                    {{ $item->title }}
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">
                                {{ $item->Category->name ?? 'None' }}
                            </span>
                        </td>
                        <td>
                            <span class="fw-semibold">{{ number_format($item->views) }}</span>
                        </td>
                        <td>
                            @if ($item->status == 0)
                                <span class="badge bg-secondary">Draft</span>
                            @elseif ($item->status == 1)
                                <span class="badge bg-success">Published</span>
                            @elseif ($item->status == 2)
                                <span class="badge bg-warning text-dark">Revision</span>
                            @else
                                <span class="badge bg-light text-muted border">{{ $item->status }}</span>
                            @endif
                        </td>
                        <td class="small text-muted">
                            {{ $item->publish_date }}
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-1">
                                <a href="{{ url('p/' . $item->slug) }}" target="_blank" class="btn btn-sm btn-light border" title="Preview">
                                    <span data-feather="eye" style="width: 13px; height: 13px;"></span>
                                </a>
                                <a href="{{ url('article/' . $item->id . '/edit') }}" class="btn btn-sm btn-light border text-primary" title="Edit">
                                    <span data-feather="edit-2" style="width: 13px; height: 13px;"></span>
                                </a>
                                <form action="{{ url('article/' . $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this article?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border text-danger" title="Delete">
                                        <span data-feather="trash-2" style="width: 13px; height: 13px;"></span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
<script>
    new DataTable('#dataTable', {
        pageLength: 10,
        responsive: true
    });
</script>
@endpush