<!-- Responsive Top Navbar -->
<nav class="navbar navbar-expand-lg site-navbar">
    <div class="container">
        <!-- Logo & Brand -->
        <a class="navbar-brand d-inline-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('front/img/logo.svg') }}" alt="News5" height="34">
        </a>

        <!-- Mobile Hamburger Toggle -->
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navigation Links -->
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('articles*') ? 'active' : '' }}" href="{{ url('/articles') }}">Articles</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu shadow-sm border-0" style="background: var(--bg-surface); border: 1px solid var(--border-color) !important; border-radius: var(--radius-md);">
                        @if (isset($category_navbar))
                            @foreach ($category_navbar as $item)
                                <li>
                                    <a class="dropdown-item py-2" href="{{ url('category/' . $item->slug) }}">
                                        {{ $item->name }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="{{ url('/about') }}">About</a>
                </li>
            </ul>

            <!-- Right Actions: Only visible if Admin is logged in -->
            @auth
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ url('/dashboard') }}" class="nav-cta-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                        Dashboard
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>
