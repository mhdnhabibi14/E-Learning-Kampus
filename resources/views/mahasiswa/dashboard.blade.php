@extends('layouts.apk')
@section('title', 'Dashboard Mahasiswa')
@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Dashboard Mahasiswa</h1>
            <p class="page-subtitle">
                Pantau kegiatan pembelajaran Anda.
            </p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card card-stat">
                <div class="card-header">
                    <span class="stat-label">Kelas Saya</span>
                </div>
                <div class="stat-value">0</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-stat">
                <div class="card-header">
                    <span class="stat-label">Tugas</span>
                </div>
                <div class="stat-value">0</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-stat">
                <div class="card-header">
                    <span class="stat-label">Nilai</span>
                </div>
                <div class="stat-value">0</div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Selamat Datang</h2>
                </div>
                <div class="card-body">
                    Halo,
                    <strong>{{ auth()->user()->name }}</strong>.
                    Anda login sebagai mahasiswa.
                </div>
            </div>
        </div>
    </div>
@endsection
