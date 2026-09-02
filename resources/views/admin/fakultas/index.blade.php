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

            <a href="{{ route('admin.fakultas.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>
                Tambah Fakultas
            </a>
        </div>

        <div class="card">
            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle">

                        <thead>
                            <tr>
                                <th width="60">No</th>
                                <th>Kode</th>
                                <th>Nama Fakultas</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($fakultas as $item)
                                <tr>
                                    <td>
                                        {{ $fakultas->firstItem() + $loop->index }}
                                    </td>

                                    <td>
                                        <span class="fw-semibold">
                                            {{ $item->kode_fakultas }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $item->nama_fakultas }}
                                    </td>

                                    <td>
                                        {{ $item->deskripsi ?? '-' }}
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
                                        <div class="d-flex gap-1">

                                            <a href="{{ route('admin.fakultas.show', $item) }}" class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <a href="{{ route('admin.fakultas.edit', $item) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                        </div>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        Belum ada data fakultas.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                </div>

                <div class="mt-3">
                    {{ $fakultas->links() }}
                </div>

            </div>
        </div>

    </div>

@endsection
