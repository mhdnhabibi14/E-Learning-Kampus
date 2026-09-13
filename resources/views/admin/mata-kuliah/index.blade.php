@extends('layouts.apk')

@section('title', $pageTitle)

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">{{ $pageTitle }}</h1>
                <p class="text-muted mb-0">
                    Kelola data mata kuliah
                </p>
            </div>
            {{-- Action --}}
            <div>
                <x-admin.mata-kuliah.form-mata-kuliah />
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body py-1">
                <form method="GET" action="{{ route('admin.mata-kuliah.index') }}">
                    <div class="d-flex flex-column flex-md-row align-items-md-center gap-2">

                        {{-- Per Page --}}
                        <div>
                            <x-per-page-option />
                        </div>

                        {{-- Search --}}
                        <div class="flex-grow-1">
                            <x-filter-by-field term="search" placeholder="Cari Mata Kuliah..." />
                        </div>

                        {{-- Filter by Prodi --}}
                        <div>
                            <x-admin.mata-kuliah.filter-by-prodi />
                        </div>

                        {{-- Filter by Semester --}}
                        <div>
                            <x-admin.mata-kuliah.filter-by-semester />
                        </div>

                        {{-- Reset Filter --}}
                        <div>
                            <x-button-reset-filter route="admin.mata-kuliah.index" />
                        </div>
                    </div>
                </form>

                <div class="table responsive mt-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-muted small" style="width: 60px;">NO</th>
                                <th scope="col" class="text-muted small">KODE MATKUL</th>
                                <th scope="col" class="text-muted small">NAMA MATKUL</th>
                                <th scope="col" class="text-muted small">PROGRAM STUDI</th>
                                <th scope="col" class="text-muted small">SKS</th>
                                <th scope="col" class="text-muted small">SEMESTER</th>
                                <th scope="col" class="text-muted small">STATUS</th>
                                <th scope="col" class="text-muted small text-center" style="width: 120px;">OPSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mataKuliah as $index => $item)
                                <tr>
                                    <td class="text-muted">{{ $mataKuliah->firstItem() + $index }}</td>
                                    <td>
                                        <span class="fw-semibold text-dark"> {{ $item->kode_mata_kuliah }} </span>
                                    </td>
                                    <td>
                                        <span class="fw-semibold text-dark"> {{ $item->nama_mata_kuliah }} </span>
                                        @if ($item->deskripsi)
                                            <div class="text-muted small mt-1">{{ Str::limit($item->deskripsi, 50) }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        <span
                                            class="fw-semibold text-dark">{{ $item->programStudi?->nama_prodi ?? '-' }}</span>
                                        <div class="text-muted small">
                                            {{ $item->programStudi?->fakultas?->nama_fakultas ?? '-' }}
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="badge bg-primary-subtle text-primary fw-medium">{{ $item->sks }}</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">Semester {{ $item->semester }}</span>
                                    </td>
                                    <td>
                                        @if ($item->is_active)
                                            <span class="badge bg-success-subtle text-success"> Aktif </span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger"> Tidak Aktif </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-1">
                                            <x-admin.mata-kuliah.form-mata-kuliah id="{{ $item->id }}" />
                                            <x-confirm-delete id="{{ $item->id }}" route="admin.mata-kuliah.destroy" />
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="text-muted"> <i class="bi bi-book fs-1 d-block mb-3"></i>
                                            <h6 class="mb-1"> Belum ada data Mata Kuliah </h6>
                                            <p class="small mb-0"> Data prodi yang ditambahkan akan muncul di sini. </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $mataKuliah->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @if (session('open_modal'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modalElement = document.getElementById(
                    '{{ session('open_modal') }}'
                );

                if (modalElement) {
                    const modal = new bootstrap.Modal(modalElement);
                    modal.show();
                }
            });
        </script>
    @endif
@endpush
