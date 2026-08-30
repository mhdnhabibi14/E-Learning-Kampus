<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', config('app.name', 'E-Learning Kampus'))
    </title>

    <meta name="description" content="E-Learning Kampus">
    <meta name="author" content="E-Learning Kampus">

    <link rel="icon" type="image/png" href="{{ asset('template') }}/assets/images/favicon.ico">

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('template') }}/assets/libs/bootstrap/css/bootstrap.min.css">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="{{ asset('template') }}/assets/libs/bootstrap-icons/bootstrap-icons.css">

    {{-- ApexCharts --}}
    <link rel="stylesheet" href="{{ asset('template') }}/assets/libs/apexcharts/apexcharts.css">

    {{-- Flatpickr --}}
    <link rel="stylesheet" href="{{ asset('template') }}/assets/libs/flatpickr/flatpickr.min.css">

    {{-- Spark Admin --}}
    <link rel="stylesheet" href="{{ asset('template') }}/assets/css/main.css">

    @stack('styles')
</head>

<body>

    {{-- =====================================================
        SIDEBAR
    ====================================================== --}}
    <div class="sidebar-wrapper" id="sidebar">

        {{-- Brand --}}
        <a href="{{ route(auth()->user()->role . '.dashboard') }}" class="sidebar-brand text-decoration-none">

            <i class="bi bi-asterisk"></i>

            <span>E-Learning Kampus</span>
        </a>

        {{-- Navigation --}}
        <div class="flex-grow-1 overflow-y-auto">

            {{-- Dashboard --}}
            <div class="sidebar-menu-section">

                <div class="sidebar-menu-title">
                    Menu
                </div>

                <ul class="sidebar-menu-list">

                    <li class="sidebar-menu-item">

                        <a href="{{ route(auth()->user()->role . '.dashboard') }}"
                            class="sidebar-menu-link {{ request()->routeIs(auth()->user()->role . '.dashboard') ? 'active' : '' }}">

                            <i class="bi bi-grid-fill"></i>

                            <span>Dashboard</span>

                        </a>

                    </li>

                </ul>

            </div>


            {{-- =================================================
                MENU ADMIN
            ================================================== --}}
            @if (auth()->user()->role === 'admin')
                <div class="sidebar-menu-section">

                    <div class="sidebar-menu-title">
                        Akademik
                    </div>

                    <ul class="sidebar-menu-list">

                        <li class="sidebar-menu-item">
                            <a href="#" class="sidebar-menu-link">

                                <i class="bi bi-building"></i>

                                <span>Fakultas</span>

                            </a>
                        </li>

                        <li class="sidebar-menu-item">
                            <a href="#" class="sidebar-menu-link">

                                <i class="bi bi-diagram-3"></i>

                                <span>Program Studi</span>

                            </a>
                        </li>

                        <li class="sidebar-menu-item">
                            <a href="#" class="sidebar-menu-link">

                                <i class="bi bi-calendar3"></i>

                                <span>Tahun Akademik</span>

                            </a>
                        </li>

                    </ul>

                </div>


                <div class="sidebar-menu-section">

                    <div class="sidebar-menu-title">
                        Pengguna
                    </div>

                    <ul class="sidebar-menu-list">

                        <li class="sidebar-menu-item">
                            <a href="#" class="sidebar-menu-link">

                                <i class="bi bi-people"></i>

                                <span>Data Pengguna</span>

                            </a>
                        </li>

                        <li class="sidebar-menu-item">
                            <a href="#" class="sidebar-menu-link">

                                <i class="bi bi-person-badge"></i>

                                <span>Dosen</span>

                            </a>
                        </li>

                        <li class="sidebar-menu-item">
                            <a href="#" class="sidebar-menu-link">

                                <i class="bi bi-mortarboard"></i>

                                <span>Mahasiswa</span>

                            </a>
                        </li>

                    </ul>

                </div>
            @endif


            {{-- =================================================
                MENU DOSEN
            ================================================== --}}
            @if (auth()->user()->role === 'dosen')
                <div class="sidebar-menu-section">

                    <div class="sidebar-menu-title">
                        Pembelajaran
                    </div>

                    <ul class="sidebar-menu-list">

                        <li class="sidebar-menu-item">
                            <a href="#" class="sidebar-menu-link">

                                <i class="bi bi-journal-bookmark"></i>

                                <span>Mata Kuliah</span>

                            </a>
                        </li>

                        <li class="sidebar-menu-item">
                            <a href="#" class="sidebar-menu-link">

                                <i class="bi bi-easel"></i>

                                <span>Kelas Saya</span>

                            </a>
                        </li>

                        <li class="sidebar-menu-item">
                            <a href="#" class="sidebar-menu-link">

                                <i class="bi bi-file-earmark-text"></i>

                                <span>Materi</span>

                            </a>
                        </li>

                        <li class="sidebar-menu-item">
                            <a href="#" class="sidebar-menu-link">

                                <i class="bi bi-file-earmark-check"></i>

                                <span>Tugas</span>

                            </a>
                        </li>

                        <li class="sidebar-menu-item">
                            <a href="#" class="sidebar-menu-link">

                                <i class="bi bi-question-circle"></i>

                                <span>Kuis</span>

                            </a>
                        </li>

                        <li class="sidebar-menu-item">
                            <a href="#" class="sidebar-menu-link">

                                <i class="bi bi-chat-dots"></i>

                                <span>Diskusi</span>

                            </a>
                        </li>

                        <li class="sidebar-menu-item">
                            <a href="#" class="sidebar-menu-link">

                                <i class="bi bi-bar-chart"></i>

                                <span>Nilai</span>

                            </a>
                        </li>

                    </ul>

                </div>
            @endif


            {{-- =================================================
                MENU MAHASISWA
            ================================================== --}}
            @if (auth()->user()->role === 'mahasiswa')
                <div class="sidebar-menu-section">

                    <div class="sidebar-menu-title">
                        Pembelajaran
                    </div>

                    <ul class="sidebar-menu-list">

                        <li class="sidebar-menu-item">
                            <a href="#" class="sidebar-menu-link">

                                <i class="bi bi-journal-bookmark"></i>

                                <span>Kelas Saya</span>

                            </a>
                        </li>

                        <li class="sidebar-menu-item">
                            <a href="#" class="sidebar-menu-link">

                                <i class="bi bi-file-earmark-text"></i>

                                <span>Materi</span>

                            </a>
                        </li>

                        <li class="sidebar-menu-item">
                            <a href="#" class="sidebar-menu-link">

                                <i class="bi bi-file-earmark-check"></i>

                                <span>Tugas</span>

                            </a>
                        </li>

                        <li class="sidebar-menu-item">
                            <a href="#" class="sidebar-menu-link">

                                <i class="bi bi-question-circle"></i>

                                <span>Kuis</span>

                            </a>
                        </li>

                        <li class="sidebar-menu-item">
                            <a href="#" class="sidebar-menu-link">

                                <i class="bi bi-chat-dots"></i>

                                <span>Diskusi</span>

                            </a>
                        </li>

                        <li class="sidebar-menu-item">
                            <a href="#" class="sidebar-menu-link">

                                <i class="bi bi-bar-chart"></i>

                                <span>Nilai</span>

                            </a>
                        </li>

                    </ul>

                </div>
            @endif

        </div>

    </div>


    {{-- =====================================================
        MAIN WRAPPER
    ====================================================== --}}
    <div class="main-wrapper">

        {{-- =================================================
            NAVBAR
        ================================================== --}}
        <header class="navbar-custom">


            {{-- Left --}}
            <div class="navbar-left">

                <button class="btn-desktop-toggle d-none d-xl-flex align-items-center justify-content-center me-3"
                    id="desktop-sidebar-toggle" aria-label="Minimize Sidebar">

                    <i class="bi bi-chevron-bar-left"></i>

                </button>

                <button class="sidebar-toggle-btn me-2" id="sidebar-toggle" aria-label="Toggle Navigation">

                    <i class="bi bi-list"></i>

                </button>

            </div>


            {{-- Navbar Actions --}}
            <div class="navbar-actions">

                {{-- Notifications --}}
                <div class="dropdown">

                    <button class="navbar-action-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">

                        <i class="bi bi-bell"></i>

                    </button>

                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-notification p-0">

                        <div class="notification-header">
                            <h6 class="notification-title">
                                Notifikasi
                            </h6>
                        </div>

                        <div class="notification-list">

                            <div class="notification-item">

                                <div class="notification-icon bg-primary text-white">
                                    <i class="bi bi-info-circle"></i>
                                </div>

                                <div class="notification-content">

                                    <p class="notification-text mb-0">
                                        Belum ada notifikasi.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Profile --}}
                <div class="dropdown ms-2">

                    <button class="navbar-profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">

                        <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('template/assets/images/avatar.png') }}"
                            alt="{{ auth()->user()->name }}" class="navbar-profile-img">

                        <span class="navbar-profile-name d-none d-md-inline">
                            {{ auth()->user()->name }}
                        </span>

                        <i class="bi bi-chevron-down navbar-profile-caret"></i>

                    </button>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile">

                        <li class="dropdown-header">
                            {{ ucfirst(auth()->user()->role) }}
                        </li>

                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-person"></i>
                                Profil
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-gear"></i>
                                Pengaturan
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item text-danger" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                                <i class="bi bi-box-arrow-right"></i>
                                Logout

                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>

                    </ul>

                </div>

            </div>

        </header>





        {{-- =================================================
            PAGE CONTENT
        ================================================== --}}
        <main>

            @yield('content')

        </main>


        {{-- =================================================
            FOOTER
        ================================================== --}}
        <footer class="footer-custom">

            <div class="footer-left">

                <span class="footer-logo">

                    <i class="bi bi-asterisk"></i>

                    E-Learning Kampus

                </span>

                <span class="footer-separator">
                    |
                </span>

                <span class="footer-copy">

                    &copy; {{ date('Y') }}

                    E-Learning Kampus

                </span>

            </div>

            <div class="footer-right">

                <ul class="footer-links">

                    <li>
                        <a href="#" class="footer-link">
                            Bantuan
                        </a>
                    </li>

                    <li>
                        <a href="#" class="footer-link">
                            Dokumentasi
                        </a>
                    </li>

                </ul>

            </div>

        </footer>

    </div>


    {{-- =====================================================
        JAVASCRIPT
    ====================================================== --}}

    <script src="{{ asset('template') }}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('template') }}/assets/libs/apexcharts/apexcharts.min.js"></script>

    <script src="{{ asset('template') }}/assets/libs/flatpickr/flatpickr.min.js"></script>

    <script src="{{ asset('template') }}/assets/js/dashboard.js"></script>

    @stack('scripts')

</body>

</html>
