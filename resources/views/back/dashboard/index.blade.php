@extends('back.layout.template')

@section('title', 'Dashboard')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <!-- Welcome Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3 mb-4 border-bottom">
        <div>
            <h1 class="h3 fw-bold mb-1" style="color: #0F172A; letter-spacing: -0.02em;">Welcome back, {{ auth()->user()->name }} 👋</h1>
            <p class="text-muted small mb-0">Here is the publication overview and editorial performance metrics for today.</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ url('article/create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                <span data-feather="plus"></span>
                New Article
            </a>
        </div>
    </div>

    <!-- Stat Counter Cards -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-4">
            <div class="admin-stat-card">
                <div>
                    <span class="text-muted text-uppercase fw-bold" style="font-size: 11px; letter-spacing: 0.05em;">Total Published Articles</span>
                    <h2 class="display-6 fw-bold my-1 text-dark">{{ $total_articles }}</h2>
                    <a href="{{ url('article') }}" class="text-decoration-none small text-primary fw-semibold">Manage Articles →</a>
                </div>
                <div class="stat-icon-wrapper" style="background: #F1F5F9; color: #0F172A;">
                    <span data-feather="file-text" style="width: 24px; height: 24px;"></span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-4">
            <div class="admin-stat-card">
                <div>
                    <span class="text-muted text-uppercase fw-bold" style="font-size: 11px; letter-spacing: 0.05em;">Active Categories</span>
                    <h2 class="display-6 fw-bold my-1 text-dark">{{ $total_categories }}</h2>
                    <a href="{{ url('categories') }}" class="text-decoration-none small text-primary fw-semibold">View Categories →</a>
                </div>
                <div class="stat-icon-wrapper" style="background: #FFF1F2; color: #E11D48;">
                    <span data-feather="tag" style="width: 24px; height: 24px;"></span>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-xl-4">
            <div class="admin-stat-card">
                <div>
                    <span class="text-muted text-uppercase fw-bold" style="font-size: 11px; letter-spacing: 0.05em;">System Status</span>
                    <h4 class="fw-bold my-2 text-success d-flex align-items-center gap-2">
                        <span class="d-inline-block rounded-circle bg-success" style="width: 8px; height: 8px;"></span>
                        Online & Running
                    </h4>
                    <span class="text-muted small">Laravel 11 • MySQL 8</span>
                </div>
                <div class="stat-icon-wrapper" style="background: #ECFDF5; color: #059669;">
                    <span data-feather="activity" style="width: 24px; height: 24px;"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Tables Grid -->
    <div class="row g-4">
        <!-- Latest Articles Card -->
        <div class="col-lg-6">
            <div class="admin-card h-100">
                <div class="admin-card-title">
                    <span>Recent Dispatches</span>
                    <a href="{{ url('article') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3" style="font-size: 12px;">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Headline</th>
                                <th>Topic</th>
                                <th>Date</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latest_article as $item)
                                <tr>
                                    <td class="text-muted small">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="fw-semibold text-truncate" style="max-width: 220px;" title="{{ $item->title }}">
                                            {{ $item->title }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            {{ $item->Category->name ?? 'Uncategorized' }}
                                        </span>
                                    </td>
                                    <td class="small text-muted">
                                        {{ $item->created_at ? $item->created_at->format('d M') : '-' }}
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ url('p/' . $item->slug) }}" target="_blank" class="btn btn-sm btn-light border py-1 px-2" title="View Public Post">
                                            <span data-feather="external-link" style="width: 13px; height: 13px;"></span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No recent articles found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Popular Articles Card -->
        <div class="col-lg-6">
            <div class="admin-card h-100">
                <div class="admin-card-title">
                    <span>Most Viewed Stories</span>
                    <span class="badge bg-light text-secondary border">Analytics</span>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Headline</th>
                                <th>Topic</th>
                                <th>Views</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($popular_article as $item)
                                <tr>
                                    <td class="text-muted small">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="fw-semibold text-truncate" style="max-width: 220px;" title="{{ $item->title }}">
                                            {{ $item->title }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            {{ $item->Category->name ?? 'Uncategorized' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-dark">{{ number_format($item->views) }}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ url('p/' . $item->slug) }}" target="_blank" class="btn btn-sm btn-light border py-1 px-2" title="View Public Post">
                                            <span data-feather="external-link" style="width: 13px; height: 13px;"></span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No popular articles recorded.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
