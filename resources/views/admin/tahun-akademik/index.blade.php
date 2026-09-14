@extends('layouts.apk')

@section('title', $pageTitle)

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">{{ $pageTitle }}</h1>
                <p class="text-muted mb-0">
                    Kelola data tahun akademik
                </p>
            </div>
            {{-- Action --}}
            <div>
                <x-admin.tahun-akademik.form-tahun-akademik />
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body py-1">
                <form method="GET" action="#">
                    <div class="d-flex flex-column flex-md-row align-items-md-center gap-2">

                        {{-- Per Page --}}
                        <div>
                            <x-per-page-option />
                        </div>

                        {{-- Search --}}
                        <div class="flex-grow-1">
                            <x-filter-by-field term="search" placeholder="Cari Tahun Akademik..." />
                        </div>

                        {{-- Filter by Semester --}}
                        <div>
                            <x-admin.tahun-akademik.filter-by-semester />
                        </div>

                        {{-- Reset Filter --}}
                        <div>
                            <x-button-reset-filter route="admin.tahun-akademik.index" />
                        </div>
                    </div>
                </form>

                <div class="table responsive mt-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-muted small" style="width: 60px;">NO</th>
                                <th scope="col" class="text-muted small">KODE TAHUN AKADEMIK</th>
                                <th scope="col" class="text-muted small">NAMA TAHUN AKADEMIK</th>
                                <th scope="col" class="text-muted small">SEMESTER</th>
                                <th scope="col" class="text-muted small">PERIODE</th>
                                <th scope="col" class="text-muted small">STATUS</th>
                                <th scope="col" class="text-muted small text-center" style="width: 120px;">OPSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tahunAkademik as $index => $item)
                                <tr>
                                    <td class="text-muted">{{ $tahunAkademik->firstItem() + $index }}</td>
                                    <td>
                                        <span class="fw-semibold text-dark"> {{ $item->kode_tahun_akademik }} </span>
                                    </td>
                                    <td>
                                        <span class="fw-semibold text-dark"> {{ $item->nama_tahun_akademik }} </span>
                                    </td>
                                    <td>
                                        @if ($item->semester === 'Ganjil')
                                            <span class="badge bg-primary-subtle text-primary">Ganjil</span>
                                        @else
                                            <span class="badge bg-info-subtle text-info">Genap</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="small">
                                            <div>
                                                <i class="bi bi-calendar-event me-1 text-muted"></i>
                                                {{ $item->tanggal_mulai?->format('d M Y') ?? '-' }}
                                            </div>

                                            <div class="text-muted">
                                                <i class="bi bi-arrow-down-short me-1"></i>
                                                {{ $item->tanggal_selesai?->format('d M Y') ?? '-' }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($item->is_active)
                                            <span class="badge bg-success">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                Tidak Aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-1">
                                            <x-admin.tahun-akademik.form-tahun-akademik id="{{ $item->id }}" />
                                            <x-confirm-delete id="{{ $item->id }}"
                                                route="admin.tahun-akademik.destroy" />
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="text-muted"> <i class="bi bi-calendar3 fs-1 d-block mb-3"></i>
                                            <h6 class="mb-1"> Belum ada data tahun akademik </h6>
                                            <p class="small mb-0"> Data tahun akademil yang ditambahkan akan muncul di sini.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $tahunAkademik->links() }}
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
