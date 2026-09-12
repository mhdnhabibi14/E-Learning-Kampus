@extends('layouts.apk')

@section('title', $pageTitle)
@section('content')
    <div class="container-fluid">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="mb-1">
                    {{ $pageTitle }}
                </h4>

                <p class="text-muted mb-0">
                    Kelola data mata kuliah.
                </p>
            </div>

            <div>
                <x-admin.mata-kuliah.form-mata-kuliah />
            </div>

        </div>


        {{-- Filter --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <form method="GET" action="{{ route('admin.mata-kuliah.index') }}">

                    <div class="d-flex flex-column flex-md-row align-items-md-center gap-2">

                        {{-- Filter Program Studi --}}


                        {{-- Filter Semester --}}
                        <div>
                            <select name="semester" id="semester" class="form-select form-select-sm"
                                onchange="this.form.submit()">
                                <option value="">
                                    Semua Semester
                                </option>

                                @for ($i = 1; $i <= 14; $i++)
                                    <option value="{{ $i }}" {{ request('semester') == $i ? 'selected' : '' }}>
                                        Semester {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        {{-- Search --}}
                        <div class="flex-grow-1">
                            <x-filter-by-field term="search" placeholder="Cari kode atau nama mata kuliah..." />
                        </div>

                        {{-- Per Page --}}
                        <div>
                            <x-per-page-option />
                        </div>

                        {{-- Reset --}}
                        <x-button-reset-filter route="admin.mata-kuliah.index" />

                    </div>

                </form>


                {{-- Table --}}
                <div class="table-responsive mt-4">

                    <table class="table table-hover align-middle mb-0">

                        <thead>
                            <tr>

                                <th scope="col" class="text-muted text-uppercase small fw-semibold" style="width: 60px;">
                                    #
                                </th>

                                <th scope="col" class="text-muted text-uppercase small fw-semibold">
                                    Kode
                                </th>

                                <th scope="col" class="text-muted text-uppercase small fw-semibold">
                                    Mata Kuliah
                                </th>

                                <th scope="col" class="text-muted text-uppercase small fw-semibold">
                                    Program Studi
                                </th>

                                <th scope="col" class="text-muted text-uppercase small fw-semibold text-center"
                                    style="width: 80px;">
                                    SKS
                                </th>

                                <th scope="col" class="text-muted text-uppercase small fw-semibold text-center"
                                    style="width: 120px;">
                                    Semester
                                </th>

                                <th scope="col" class="text-muted text-uppercase small fw-semibold text-center"
                                    style="width: 120px;">
                                    Status
                                </th>

                                <th scope="col" class="text-muted text-uppercase small fw-semibold text-center"
                                    style="width: 120px;">
                                    Aksi
                                </th>

                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($mataKuliah as $index => $item)
                                <tr>

                                    <td class="text-muted">
                                        {{ $mataKuliah->firstItem() + $index }}
                                    </td>

                                    <td>
                                        <span class="fw-semibold text-dark">
                                            {{ $item->kode_mata_kuliah }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="fw-semibold text-dark">
                                            {{ $item->nama_mata_kuliah }}
                                        </span>

                                        @if ($item->deskripsi)
                                            <div class="text-muted small mt-1">
                                                {{ Str::limit($item->deskripsi, 50) }}
                                            </div>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="fw-semibold text-dark">
                                            {{ $item->programStudi->nama_prodi }}
                                        </span>

                                        <div class="text-muted small">
                                            {{ $item->programStudi->fakultas->nama_fakultas }}
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <span class="badge bg-primary-subtle text-primary fw-medium">
                                            {{ $item->sks }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <span class="text-muted">
                                            Semester {{ $item->semester }}
                                        </span>
                                    </td>

                                    <td class="text-center">

                                        @if ($item->is_active)
                                            <span class="badge bg-success-subtle text-success fw-medium">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger fw-medium">
                                                Tidak Aktif
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        <div class="d-flex justify-content-center align-items-center gap-1">

                                            <x-admin.mata-kuliah.form-mata-kuliah :id="$item->id" />

                                            <x-confirm-delete route="admin.mata-kuliah.destroy" :id="$item->id" />

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="8" class="text-center py-5">

                                        <div class="text-muted">

                                            <i class="bi bi-book fs-1 d-block mb-3"></i>

                                            <h6 class="mb-1">
                                                Belum ada data Mata Kuliah
                                            </h6>

                                            <p class="small mb-0">
                                                Data mata kuliah yang ditambahkan akan muncul di sini.
                                            </p>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mt-3">

                    <div class="text-muted small">

                        Menampilkan

                        <strong>
                            {{ $mataKuliah->firstItem() ?? 0 }}
                        </strong>

                        sampai

                        <strong>
                            {{ $mataKuliah->lastItem() ?? 0 }}
                        </strong>

                        dari

                        <strong>
                            {{ $mataKuliah->total() }}
                        </strong>

                        data

                    </div>

                    <div>
                        {{ $mataKuliah->onEachSide(1)->links() }}
                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
