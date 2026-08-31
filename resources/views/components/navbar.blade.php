@php
    $user = auth()->user();
@endphp

<header class="navbar-custom">
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
        <div class="dropdown">
            <button class="navbar-action-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="bi bi-bell"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-notification p-0">
                <div class="notification-header">
                    <h6 class="notification-title">Notifikasi</h6>
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
