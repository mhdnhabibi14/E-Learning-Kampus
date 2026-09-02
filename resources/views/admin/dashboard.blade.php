@extends('layouts.apk')
@section('title', 'Dashboard Admin')
@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">
                @yield('page_title', 'Dashboard')
            </h1>
            <p class="page-subtitle">
                Selamat datang di E-Learning Kampus.
            </p>
        </div>
    </div>

    <div class="row g-4">
        {{-- Total Pengguna --}}
        <div class="col-md-4">
            <div class="card card-stat">
                <div class="card-header">
                    <span class="stat-label">
                        Total Pengguna
                    </span>
                </div>
                <div class="stat-value">0</div>
                <div class="trend-badge trend-up">
                    <i class="bi bi-people"></i>
                    <span>Pengguna Terdaftar</span>
                </div>
            </div>
        </div>

        {{-- Total Dosen --}}
        <div class="col-md-4">
            <div class="card card-stat">
                <div class="card-header">
                    <span class="stat-label">Total Dosen</span>
                </div>
                <div class="stat-value">0</div>
                <div class="trend-badge trend-up">
                    <i class="bi bi-person-badge"></i>
                    <span>Dosen Aktif</span>
                </div>
            </div>
        </div>

        {{-- Total Mahasiswa --}}
        <div class="col-md-4">
            <div class="card card-stat">
                <div class="card-header">
                    <span class="stat-label">Total Mahasiswa
                    </span>
                </div>
                <div class="stat-value">0</div>
                <div class="trend-badge trend-up">
                    <i class="bi bi-mortarboard"></i>
                    <span>Mahasiswa Aktif</span>
                </div>
            </div>
        </div>

        {{-- Welcome --}}
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Selamat Datang</h2>
                </div>
                <div class="card-body">
                    <p class="mb-0">
                        Halo,
                        <strong>{{ auth()->user()->name }}</strong>!
                        Anda login sebagai
                        <strong>{{ ucfirst(auth()->user()->role) }}</strong>.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
