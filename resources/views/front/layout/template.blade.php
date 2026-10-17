<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="News5 - Wawasan Jurnalisme Teknologi, AI, Sains, dan Informasi Masa Depan" />
    <meta name="author" content="News5 Media" />
    @stack('meta-seo')
    <title>@yield('title', 'News5 - The Daily Insight')</title>

    <!-- Google Fonts: Newsreader (Editorial Serif) & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,500;0,6..72,600;0,6..72,700;1,6..72,400;1,6..72,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Editorial Design System -->
    <link href="{{ asset('front/css/editorial.css') }}" rel="stylesheet" />
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <link rel="icon" type="image/svg+xml" href="{{ asset('front/img/logo.svg') }}" />
    @stack('css')
</head>

<body>
    <!-- Site Preloader Screen -->
    <div id="site-preloader">
        <div class="preloader-spinner"></div>
        <div class="preloader-brand">News5 Media</div>
        <div class="text-muted small mt-2" style="font-size: 11.5px; letter-spacing: 0.05em;">Curating today's insights...</div>
    </div>

    <!-- Top Reading Scroll Progress Bar -->
    <div id="scroll-progress"></div>

    <!-- Notification Alerts -->
    @if (session('success'))
        <div class="alert alert-success border-0 rounded-0 text-center py-2 mb-0" role="alert" style="background: #10B981; color: #FFFFFF; font-size: 13.5px;">
            <div class="container">{{ session('success') }}</div>
        </div>
    @endif
    @if (session('danger'))
        <div class="alert alert-danger border-0 rounded-0 text-center py-2 mb-0" role="alert" style="background: #EF4444; color: #FFFFFF; font-size: 13.5px;">
            <div class="container">{{ session('danger') }}</div>
        </div>
    @endif

    <div class="min-vh-100 d-flex flex-column justify-content-between">
        @include('front.layout.navbar')

        <!-- Main Page Content -->
        <main class="flex-grow-1">
            @yield('content')
        </main>

        <!-- Editorial Clean Footer -->
        <footer class="editorial-footer">
            <div class="container">
                <div class="row align-items-center gy-4">
                    <div class="col-lg-5">
                        <div class="mb-3">
                            <a href="{{ url('/') }}" class="d-inline-flex align-items-center text-decoration-none">
                                <img src="{{ asset('front/img/logo-white.svg') }}" alt="News5" height="34" onerror="this.onerror=null; this.src='{{ asset('front/img/logo.svg') }}';">
                            </a>
                        </div>
                        <p class="text-muted small mb-0" style="max-width: 380px; line-height: 1.6;">
                            Media jurnalisme independen yang menyajikan kurasi informasi berbobot seputar kecerdasan buatan, sains, telekomunikasi, dan ekonomi digital.
                        </p>
                    </div>
                    <div class="col-lg-4 footer-nav text-lg-center">
                        <a href="{{ url('/') }}">Home</a>
                        <a href="{{ url('/articles') }}">Articles</a>
                        <a href="{{ url('/about') }}">About</a>
                        <a href="{{ url('/login') }}" class="text-secondary fw-semibold">Admin</a>
                    </div>
                    <div class="col-lg-3 text-lg-end">
                        <div class="small text-muted mb-1">
                            &copy; {{ date('Y') }} News5 Media Group.
                        </div>
                        <div class="small text-muted" style="font-size: 11px;">
                            All rights reserved. Dedicated to quality journalism.
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS Animation Engine -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Dismiss preloader smoothly
        window.addEventListener('load', function() {
            const preloader = document.getElementById('site-preloader');
            if (preloader) {
                setTimeout(() => {
                    preloader.classList.add('fade-out');
                }, 300);
            }
        });

        // Initialize AOS animations
        AOS.init({
            duration: 650,
            easing: 'ease-out-cubic',
            once: true,
            offset: 40
        });

        // Window Scroll Reading Progress Bar
        window.addEventListener('scroll', function() {
            const winScroll = document.documentElement.scrollTop || document.body.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            const progressBar = document.getElementById('scroll-progress');
            if (progressBar) {
                progressBar.style.width = scrolled + '%';
            }
        });

        // Secret Admin Keyboard Shortcut: Ctrl + Shift + A (or Cmd + Shift + A)
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.shiftKey && (e.key === 'A' || e.key === 'a')) {
                e.preventDefault();
                window.location.href = "{{ url('/login') }}";
            }
        });
    </script>
    @stack('js')
</body>
</html>
