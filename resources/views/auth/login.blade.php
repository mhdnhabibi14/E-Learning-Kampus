<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'E-Learning Kampus'))</title>

    <!-- SEO Optimization -->
    <meta name="description" content="Login Screen - Spark Admin Premium Bootstrap 5 Admin Dashboard Template">
    <meta name="author" content="Spark Admin Team">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('template') }}/assets/images/favicon.ico">

    <!-- Local Third-Party Libraries (100% Offline Compatible) -->
    <link rel="stylesheet" href="{{ asset('template') }}/assets/libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('template') }}/assets/libs/bootstrap-icons/bootstrap-icons.css">

    <!-- Main Design System & Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('template') }}/assets/css/main.css">
</head>

<body>

    <div class="login-wrapper">
        <!-- Glowing background shapes for modern visual appearance -->
        <div class="login-bg-shape login-bg-shape-1"></div>
        <div class="login-bg-shape login-bg-shape-2"></div>

        <!-- Main centered login card -->
        <div class="login-card">

            <!-- Brand Identity -->
            <a href="{{ route('login') }}" class="login-brand text-decoration-none">
                <i class="bi bi-asterisk"></i>
                <span>E-Learning Kampus</span>
            </a>

            <p class="login-subtitle">Silakan masuk untuk mengakses dashboard anda</p>

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="POST" id="loginForm" class="needs-validation" novalidate>
                @csrf
                <!-- Email Input Group -->
                <div class="login-form-group">
                    <label for="email" class="login-form-label">Email</label>
                    <div class="login-input-group">
                        <i class="bi bi-envelope input-icon"></i>
                        <input type="email" name="email" id="email"
                            class="login-input @error('email') is-invalid @enderror" value="{{ old('email') }}"
                            placeholder="name@gmail.com" required autocomplete="email">
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block"> {{ $message }} </div>
                    @enderror
                </div>

                <!-- Password Input Group -->
                <div class="login-form-group">
                    <label for="password" class="login-form-label">Password</label>
                    <div class="login-input-group">
                        <i class="bi bi-shield-lock input-icon"></i>
                        <input type="password" name="password" id="password"
                            class="login-input @error('password') is-invalid @enderror" placeholder="••••••••" required
                            autocomplete="current-password">
                        <button type="button" class="password-toggle-btn" id="toggle-password"
                            aria-label="Show password">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block"> {{ $message }} </div>
                    @enderror
                </div>

                <!-- Options (Remember me & Forgot Password) -->
                <div class="login-options">
                    <label class="login-remember"> <input type="checkbox" name="remember" value="1"
                            {{ old('remember') ? 'checked' : '' }}> <span> Ingat saya </span> </label>
                    <a href="#" class="forgot-password-link">Lupa Password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-login" id="btn-submit">
                    <span>LOGIN</span>
                    <i class="bi bi-arrow-right"></i>
                </button>

            </form>

            <!-- Divider -->
            <div class="login-divider">
                Belum punya akun? <a href="#" id="link-register">Daftar disini</a>
            </div>

        </div>
    </div>
    <!-- END: Authentication Container -->

    <!-- Local Bootstrap bundle -->
    <script src="{{ asset('template') }}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Authentication interactions script -->
    <script src="{{ asset('template') }}/assets/js/auth.js"></script>
</body>

</html>
