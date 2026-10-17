<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
    <div class="sidebar-sticky">
        <div class="px-3 py-2 mb-2 text-uppercase fw-bold text-muted" style="font-size: 10px; letter-spacing: 0.1em;">
            Editorial Controls
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}">
                    <span data-feather="grid"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('article*') ? 'active' : '' }}" href="{{ url('article') }}">
                    <span data-feather="file-text"></span>
                    Articles
                </a>
            </li>

            @if (auth()->user()->role == 1)
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('categories*') ? 'active' : '' }}" href="{{ url('categories') }}">
                        <span data-feather="tag"></span>
                        Categories
                    </a>
                </li>
            @endif

            @if (auth()->user()->role == 1)
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('config*') ? 'active' : '' }}" href="{{ url('config') }}">
                        <span data-feather="sliders"></span>
                        Configurations
                    </a>
                </li>
            @endif

            <li class="nav-item">
                <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}" href="{{ url('users') }}">
                    <span data-feather="users"></span>
                    Staff & Users
                </a>
            </li>

            <div class="px-3 py-2 mt-3 mb-1 text-uppercase fw-bold text-muted" style="font-size: 10px; letter-spacing: 0.1em;">
                Preferences
            </div>

            <li class="nav-item">
                <a class="nav-link" href="#" onclick="confirmLogout(event)">
                    <span data-feather="log-out" style="color: #F43F5E;"></span>
                    <span style="color: #FDA4AF;">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmLogout(event) {
        event.preventDefault();
        Swal.fire({
            title: "Sign Out",
            text: "Are you sure you want to exit the dashboard?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#0F172A",
            cancelButtonColor: "#64748B",
            confirmButtonText: "Yes, Sign Out",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>
