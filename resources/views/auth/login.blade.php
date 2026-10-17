<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sign In - News5</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,500;0,6..72,600;1,6..72,400&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="{{ asset('front/img/logo.svg') }}">

    <style>
        :root {
            --bg-auth: #FAF9F6;
            --text-dark: #0F172A;
            --accent-red: #E11D48;
            --border-color: #E2E8F0;
        }

        body {
            background-color: var(--bg-auth);
            color: var(--text-dark);
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .auth-card-container {
            width: 100%;
            max-width: 440px;
        }

        .auth-card {
            background: #FFFFFF;
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 36px 32px;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.05), 0 8px 10px -6px rgba(15, 23, 42, 0.03);
        }

        .auth-brand-logo {
            display: inline-block;
            margin-bottom: 20px;
        }

        .auth-title {
            font-family: 'Newsreader', serif;
            font-size: 1.85rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 6px;
            letter-spacing: -0.02em;
        }

        .auth-subtitle {
            font-size: 13.5px;
            color: #64748B;
            margin-bottom: 24px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }

        .form-control {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 11px 14px;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: #0F172A;
            box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.08);
        }

        .btn-auth-submit {
            background: #0F172A;
            color: #FFFFFF;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-size: 14px;
            font-weight: 600;
            width: 100%;
            transition: all 0.2s ease;
        }

        .btn-auth-submit:hover {
            background: #1E293B;
            color: #FFFFFF;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15);
        }

        .auth-footer-link {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #64748B;
        }

        .auth-footer-link a {
            color: #0F172A;
            font-weight: 600;
            text-decoration: none;
        }

        .auth-footer-link a:hover {
            color: var(--accent-red);
        }
    </style>
</head>

<body>
    <div class="auth-card-container">
        <!-- Back to publication Link -->
        <div class="mb-3 text-start">
            <a href="{{ url('/') }}" class="text-secondary small text-decoration-none d-inline-flex align-items-center gap-1 fw-semibold">
                &larr; Back to publication
            </a>
        </div>

        <div class="auth-card">
            <!-- Brand Logo -->
            <div class="text-center">
                <a href="{{ url('/') }}" class="auth-brand-logo">
                    <img src="{{ asset('front/img/logo.svg') }}" height="38" alt="News5">
                </a>
                <h1 class="auth-title">Welcome Back</h1>
                <p class="auth-subtitle">Sign in to your News5 account</p>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger border-0 rounded-3 py-2 small mb-3">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Input -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" placeholder="name@domain.com" required autocomplete="email" autofocus>
                </div>

                <!-- Password Input -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                           name="password" placeholder="••••••••" required autocomplete="current-password">
                </div>

                <!-- Remember Me & Register link -->
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" checked>
                        <label class="form-check-label small text-muted" for="remember">
                            Remember me
                        </label>
                    </div>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="small fw-semibold text-decoration-none text-dark">
                            Create account
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-auth-submit">
                    Sign In
                </button>
            </form>

            <div class="auth-footer-link">
                Don't have an account yet? <a href="{{ route('register') }}">Register here</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
