@extends('layouts.apk')

@section('title', $pageTitle)

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">{{ $pageTitle }}</h1>
                <p class="text-muted mb-0">
                    Kelola data program studi
                </p>
            </div>
        </div>

        <div class="card">
            <div class="card-body py-1">
                <div class="row align-items-center mb-4">
                    {{-- Per Page + Search --}}
                    <div class="col-md-9">
                        <form method="GET" action="{{ route('admin.prodi.index') }}">
                            <div class="row align-items-center">

                                {{-- Per Page --}}
                                <div class="col-md-3">
                                    <x-per-page-option />
                                </div>

                                {{-- Search --}}
                                <div class="col-md-4">
                                    <x-filter-by-field term="search" placeholder="Cari Program Studi..." />
                                </div>

                                {{-- Filter by Fakultas --}}
                                <div class="col-md-3">
                                    <x-admin.prodi.filter-by-fakultas />
                                </div>

                                {{-- Reset Filter --}}
                                <div class="col-md-2">
                                    <x-button-reset-filter route="admin.prodi.index" />
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- Action --}}
                    <div class="col-md-3 d-flex justify-content-end">
                        <x-admin.prodi.form-prodi />
                    </div>
                </div>

                <div class="table responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-muted small" style="width: 60px;">NO</th>
                                <th scope="col" class="text-muted small">KODE PRODI</th>
                                <th scope="col" class="text-muted small">NAMA PRODI</th>
                                <th scope="col" class="text-muted small">FAKULTAS</th>
                                <th scope="col" class="text-muted small">JENJANG</th>
                                <th scope="col" class="text-muted small">DESKRIPSI</th>
                                <th scope="col" class="text-muted small">STATUS</th>
                                <th scope="col" class="text-muted small text-center" style="width: 120px;">OPSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($prodi as $index => $item)
                                <tr>
                                    <td class="text-muted">{{ $prodi->firstItem() + $index }}</td>
                                    <td><span class="fw-semibold"> {{ $item->kode_prodi }} </span></td>
                                    <td>
                                        <div class="fw-semibold"> {{ $item->nama_prodi }} </div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold"> {{ $item->fakultas->nama_fakultas }} </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary-subtle text-primary fw-medium"> {{ $item->jenjang }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($item->deskripsi)
                                            <span class="text-muted"> {{ Str::limit($item->deskripsi, 60) }} </span>
                                        @else
                                            <span class="text-muted fst-italic"> Tidak ada deskripsi </span>
                                        @endif
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
                                            <x-admin.prodi.form-prodi id="{{ $item->id }}" />
                                            <x-confirm-delete id="{{ $item->id }}" route="admin.prodi.destroy" />
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="text-muted"> <i class="bi bi-diagram-3 fs-1 d-block mb-3"></i>
                                            <h6 class="mb-1"> Belum ada data Prodi </h6>
                                            <p class="small mb-0"> Data prodi yang ditambahkan akan muncul di sini. </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $prodi->links() }}
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
