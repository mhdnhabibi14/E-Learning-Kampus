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
        </div>

        <div class="card">
            <div class="card-body py-1">
                <div class="row align-items-center mb-4">
                    {{-- Per Page + Search --}}
                    <div class="col-md-9">
                        <form method="GET" action="{{ route('admin.fakultas.index') }}">
                            <div class="row align-items-center">

                                {{-- Per Page --}}
                                <div class="col-md-4">
                                    <x-per-page-option />
                                </div>

                                {{-- Search --}}
                                <div class="col-md-8">
                                    {{-- Search nanti di sini --}}
                                </div>

                            </div>
                        </form>
                    </div>

                    {{-- Action --}}
                    <div class="col-md-3 d-flex justify-content-end">
                        <x-admin.fakultas.form-fakultas />
                    </div>

                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Fakultas</th>
                                <th>Nama Fakultas</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($fakultas as $index => $item)
                                <tr>
                                    <td>{{ $fakultas->firstItem() + $index }}</td>
                                    <td>{{ $item->kode_fakultas }}</td>
                                    <td>{{ $item->nama_fakultas }}</td>
                                    <td>{{ $item->deskripsi }}</td>
                                    <td>
                                        @if ($item->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Aktif</span>
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
                                    <td colspan="6" class="text-center py-4">Tidak ada data fakultas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $fakultas->links() }}
                </div>
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
