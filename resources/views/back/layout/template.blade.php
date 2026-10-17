<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard') - News5</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Base dashboard & Modern Admin CSS -->
    <link href="{{ asset('back/css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('back/css/admin-modern.css') }}" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="{{ asset('front/img/logo.svg') }}">

    @stack('css')
</head>

<body>
    <!-- Top Modern Navbar -->
    <header class="navbar admin-header px-3 d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <button class="navbar-toggler d-md-none border-0 text-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span data-feather="menu" style="color: #fff;"></span>
            </button>
            <a class="navbar-brand text-white d-flex align-items-center gap-2 m-0 text-decoration-none" href="{{ url('/dashboard') }}">
                <div class="d-flex align-items-center justify-content-center bg-danger rounded-2" style="width: 32px; height: 32px;">
                    <span class="text-white fw-black" style="font-size: 16px; font-weight: 800; line-height: 1;">N</span>
                </div>
                <span class="fw-bold fs-5 text-white" style="letter-spacing: -0.02em;">News<span class="text-danger">5</span></span>
                <span class="badge bg-danger ms-1" style="font-size: 10px; letter-spacing: 0.05em;">ADMIN</span>
            </a>
        </div>
        
        <div class="d-flex align-items-center gap-3">
            <span class="text-secondary small d-none d-sm-inline">
                Signed in as <strong class="text-white">{{ auth()->user()->name ?? auth()->user()->email }}</strong>
            </span>
            <a class="btn btn-sm btn-outline-light rounded-pill px-3 py-1" href="{{ url('/') }}" target="_blank">
                <span data-feather="external-link" style="width: 13px; height: 13px;"></span>
                View Website
            </a>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            @include('back.layout.sidebar')
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    <script>
        feather.replace();
    </script>
    @stack('js')
</body>

</html>