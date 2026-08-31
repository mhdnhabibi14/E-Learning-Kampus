@php
    $role = auth()->user()->role;
@endphp

<aside class="sidebar-wrapper" id="sidebar">

    {{-- =====================================================
        BRAND
    ====================================================== --}}
    <div class="sidebar-brand-wrapper">
        <a href="{{ route($role . '.dashboard') }}" class="sidebar-brand text-decoration-none">
            <i class="bi bi-mortarboard-fill"></i>
            <span>E-Learning Kampus</span>
        </a>
    </div>


    {{-- =====================================================
        MENU
    ====================================================== --}}
    <div class="sidebar-menu-wrapper">

        {{-- =================================================
            MENU UTAMA
        ================================================== --}}
        <div class="sidebar-menu-section">
            <div class="sidebar-menu-title">
                UTAMA
            </div>
            <ul class="sidebar-menu-list">
                <li class="sidebar-menu-item">
                    <a href="{{ route($role . '.dashboard') }}"
                        class="sidebar-menu-link
                    {{ request()->routeIs($role . '.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            </ul>
        </div>


        {{-- =================================================
            ADMIN
        ================================================== --}}
        @if ($role === 'admin')
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title">
                    AKADEMIK
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
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-journal-bookmark"></i>
                            <span>Mata Kuliah</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-easel"></i>
                            <span>Kelas</span>
                        </a>
                    </li>
                </ul>
            </div>


            {{-- Pengguna --}}
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title">
                    PENGGUNA
                </div>
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-people"></i>
                            <span>Semua Pengguna</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-person-badge"></i>
                            <span>Dosenn</span>
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


            {{-- Sistem --}}
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title">
                    SISTEM
                </div>
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-clock-history"></i>
                            <span>Activity Logs</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-envelope-paper"></i>
                            <span>Email Logs</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endif


        {{-- =================================================
            DOSEN
        ================================================== --}}
        @if ($role === 'dosen')
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title">
                    PEMBELAJARAN
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
                </ul>
            </div>


            {{-- Penilaian --}}
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title">
                    PENILAIAN
                </div>
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-clipboard-check"></i>
                            <span>Nilai Tugas</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-bar-chart"></i>
                            <span>Nilai Kuis</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endif


        {{-- =================================================
            MAHASISWA
        ================================================== --}}
        @if ($role === 'mahasiswa')
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title">
                    PEMBELAJARAN
                </div>
                <ul class="sidebar-menu-list">
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
                </ul>
            </div>


            {{-- Nilai --}}
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title">
                    NILAI
                </div>
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-clipboard-check"></i>
                            <span>Nilai Tugas</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="#" class="sidebar-menu-link">
                            <i class="bi bi-bar-chart"></i>
                            <span>Nilai Kuis</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endif
    </div>


    {{-- =====================================================
        PROFILE
    ====================================================== --}}
    <div class="sidebar-profile">
        <div class="sidebar-profile-avatar">
            @if (auth()->user()->avatar)
                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}">
            @else
                <div class="sidebar-profile-avatar-placeholder">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                </div>
            @endif
        </div>

        <div class="sidebar-profile-info">
            <div class="sidebar-profile-name">
                {{ auth()->user()->name }}
            </div>
            <div class="sidebar-profile-email">
                {{ auth()->user()->email }}
            </div>
        </div>
    </div>
</aside>
