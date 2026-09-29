@extends('layouts.apk')

@section('title', $pageTitle)

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">{{ $pageTitle }}</h1>
                <p class="text-muted mb-0">
                    Kelola data kelas
                </p>
            </div>
            {{-- Action --}}
            <div>
                <x-admin.kelas.form-kelas />
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body py-1">
                <form method="GET" action="{{ route('admin.kelas.index') }}">
                    <div class="d-flex flex-column flex-md-row align-items-md-center gap-2">

                        {{-- Per Page --}}
                        <div>
                            <x-per-page-option />
                        </div>

                        {{-- Search --}}
                        <div class="flex-grow-1">
                            <x-filter-by-field term="search" placeholder="Cari Kelas..." />
                        </div>

                        {{-- Reset Filter --}}
                        <div>
                            <x-button-reset-filter route="admin.kelas.index" />
                        </div>
                    </div>
                </form>

                <div class="table responsive mt-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-muted small" style="width: 60px;">
                                    NO
                                </th>

                                <th scope="col" class="text-muted small">
                                    KODE KELAS
                                </th>

                                <th scope="col" class="text-muted small">
                                    MATA KULIAH
                                </th>

                                <th scope="col" class="text-muted small">
                                    TAHUN AKADEMIK
                                </th>

                                <th scope="col" class="text-muted small">
                                    NAMA KELAS
                                </th>

                                <th scope="col" class="text-muted small">
                                    KUOTA
                                </th>

                                <th scope="col" class="text-muted small">
                                    STATUS
                                </th>

                                <th scope="col" class="text-muted small text-center" style="width: 120px;">
                                    OPSI
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kelas as $index => $item)
                                <tr>

                                    {{-- No --}}
                                    <td class="text-muted">
                                        {{ $kelas->firstItem() + $index }}
                                    </td>

                                    {{-- Kode Kelas --}}
                                    <td>
                                        <span class="fw-semibold">
                                            {{ $item->kode_kelas }}
                                        </span>
                                    </td>

                                    {{-- Mata Kuliah --}}
                                    <td>
                                        <div class="fw-semibold">
                                            {{ $item->mataKuliah->nama_mata_kuliah ?? '-' }}
                                        </div>

                                        @if ($item->mataKuliah)
                                            <small class="text-muted">
                                                {{ $item->mataKuliah->kode_mata_kuliah }}
                                            </small>
                                        @endif
                                    </td>

                                    {{-- Tahun Akademik --}}
                                    <td>
                                        @if ($item->tahunAkademik)
                                            <div class="fw-semibold">
                                                {{ $item->tahunAkademik->nama_tahun_akademik }}
                                            </div>

                                            <small class="text-muted">
                                                {{ $item->tahunAkademik->semester }}
                                            </small>
                                        @else
                                            <span class="text-muted">
                                                -
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Nama Kelas --}}
                                    <td>
                                        <div class="fw-semibold">
                                            {{ $item->nama_kelas }}
                                        </div>

                                        @if ($item->deskripsi)
                                            <small class="text-muted">
                                                {{ Str::limit($item->deskripsi, 50) }}
                                            </small>
                                        @endif
                                    </td>

                                    {{-- Kuota --}}
                                    <td>
                                        <span class="fw-semibold">
                                            {{ $item->kuota }}
                                        </span>
                                        <small class="text-muted">
                                            mahasiswa
                                        </small>
                                    </td>

                                    {{-- Status --}}
                                    <td>
                                        @if ($item->status === 'aktif')
                                            <span class="badge bg-success-subtle text-success">
                                                Aktif
                                            </span>
                                        @elseif ($item->status === 'draft')
                                            <span class="badge bg-warning-subtle text-warning">
                                                Draft
                                            </span>
                                        @elseif ($item->status === 'selesai')
                                            <span class="badge bg-primary-subtle text-primary">
                                                Selesai
                                            </span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger">
                                                Nonaktif
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Opsi --}}
                                    <td>
                                        <div class="d-flex align-items-center gap-1">

                                            <x-admin.kelas.form-kelas id="{{ $item->id }}" :mataKuliah="$mataKuliah"
                                                :tahunAkademik="$tahunAkademik" />

                                            <x-confirm-delete id="{{ $item->id }}" route="admin.kelas.destroy" />

                                        </div>
                                    </td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="text-muted"> <i class="bi bi-easel fs-1 d-block mb-3"></i>
                                            <h6 class="mb-1"> Belum ada data Kelas </h6>
                                            <p class="small mb-0"> Data kelas yang ditambahkan akan muncul di sini. </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $kelas->links() }}
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
