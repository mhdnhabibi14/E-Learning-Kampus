@extends('layouts.apk')

@section('title', $pageTitle)

@section('content')

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">{{ $pageTitle }}</h1>
                <p class="text-muted mb-0">
                    Kelola data fakultas
                </p>
            </div>
            {{-- Action --}}
            <div>
                <x-admin.fakultas.form-fakultas />
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body py-1">
                <form method="GET" action="{{ route('admin.fakultas.index') }}">
                    <div class="d-flex flex-column flex-md-row align-items-md-center gap-2">

                        {{-- Per Page --}}
                        <div>
                            <x-per-page-option />
                        </div>

                        {{-- Search --}}
                        <div class="flex-grow-1">
                            <x-filter-by-field term="search" placeholder="Cari Fakultas..." />
                        </div>

                        {{-- Reset Filter --}}
                        <div>
                            <x-button-reset-filter route="admin.fakultas.index" />
                        </div>
                    </div>
                </form>

                <div class="table-responsive mt-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-muted small" style="width: 60px;">NO</th>
                                <th scope="col" class="text-muted small">KODE FAKULTAS</th>
                                <th scope="col" class="text-muted small">NAMA FAKULTAS</th>
                                <th scope="col" class="text-muted small">DESKRIPSI</th>
                                <th scope="col" class="text-muted small">STATUS</th>
                                <th scope="col" class="text-muted small text-center" style="width: 120px;">OPSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($fakultas as $index => $item)
                                <tr>
                                    <td class="text-muted">{{ $fakultas->firstItem() + $index }}</td>
                                    <td><span class="fw-semibold"> {{ $item->kode_fakultas }} </span></td>
                                    <td>
                                        <div class="fw-semibold"> {{ $item->nama_fakultas }} </div>
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
                                            <x-admin.fakultas.form-fakultas id="{{ $item->id }}" />
                                            <x-confirm-delete id="{{ $item->id }}" route="admin.fakultas.destroy" />
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-muted"> <i class="bi bi-building fs-1 d-block mb-3"></i>
                                            <h6 class="mb-1"> Belum ada data Fakultas </h6>
                                            <p class="small mb-0"> Data fakultas yang ditambahkan akan muncul di sini. </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $fakultas->links() }}
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
