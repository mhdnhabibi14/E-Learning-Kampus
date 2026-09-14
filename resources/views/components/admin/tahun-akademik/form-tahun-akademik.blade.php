@php
    $uniqueId = $id ?? 'new';
    $modalId = 'formTahunAkademik' . $uniqueId;

    // Hanya gunakan old() pada modal yang sedang mengalami validasi error.
    $useOld = session('open_modal') === $modalId;
    $statusValue = $useOld ? old('is_active') : $is_active;
@endphp

<div>
    <button type="button" class="btn btn-sm {{ $id ? 'btn-primary btn-icon' : 'btn-dark' }}" data-bs-toggle="modal"
        data-bs-target="#{{ $modalId }}">
        @if ($id)
            <i class="bi bi-pencil-square"></i>
        @else
            <span class="d-flex align-items-center gap-2">
                <i class="bi bi-plus-lg"></i>
                Tahun Akademik Baru
            </span>
        @endif
    </button>

    {{-- Modal --}}
    <div class="modal fade" id="{{ $modalId }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="formTahunAkademikLabel{{ $uniqueId }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ $action }}" method="POST">
                    @csrf
                    @if ($id)
                        @method('PUT')
                    @endif
                    {{-- Modal Header --}}
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="formTahunAkademikLabel{{ $uniqueId }}">Form Tahun Akademik
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    {{-- Modal Body --}}
                    <div class="modal-body">
                        {{-- Kode Tahun Akademik --}}
                        <div class="form-group mb-2">
                            <label for="kode_tahun_akademik_{{ $uniqueId }}" class="form-label">Kode Tahun
                                Akademik</label>
                            <input type="text" class="form-control" id="kode_tahun_akademik_{{ $uniqueId }}"
                                name="kode_tahun_akademik"
                                value="{{ $useOld ? old('kode_tahun_akademik') : $kode_tahun_akademik ?? '' }}"
                                placeholder="Contoh: 2026-2027-G" maxlength="20">
                            @if ($useOld)
                                @error('kode_tahun_akademik')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            @endif
                        </div>

                        {{-- Nama Tahun Akademik --}}
                        <div class="form-group mb-2">
                            <label for="nama_tahun_akademik_{{ $uniqueId }}" class="form-label">Nama Tahun
                                Akademik</label>
                            <input type="text" class="form-control" id="nama_tahun_akademik_{{ $uniqueId }}"
                                name="nama_tahun_akademik"
                                value="{{ $useOld ? old('nama_tahun_akademik') : $nama_tahun_akademik ?? '' }}"
                                placeholder="Contoh: 2026/2027 Ganjil" maxlength="50">
                            @if ($useOld)
                                @error('nama_tahun_akademik')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            @endif
                        </div>

                        {{-- Semester --}}
                        <div class="form-group mb-2">
                            <label for="semester_{{ $uniqueId }}" class="form-label">Semester</label>
                            <select class="form-select" id="semester_{{ $uniqueId }}" name="semester">
                                <option value="">-- Pilih Semester --</option>
                                <option value="Ganjil"
                                    {{ ($useOld ? old('semester') : $semester) === 'Ganjil' ? 'selected' : '' }}>Ganjil
                                </option>
                                <option value="Genap"
                                    {{ ($useOld ? old('semester') : $semester) === 'Genap' ? 'selected' : '' }}>Genap
                                </option>
                            </select>
                            @if ($useOld)
                                @error('semester')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            @endif
                        </div>

                        {{-- Tanggal Mulai --}}
                        <div class="form-group mb-2">
                            <label for="tanggal_mulai_{{ $uniqueId }}" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tanggal_mulai_{{ $uniqueId }}"
                                name="tanggal_mulai"
                                value="{{ $useOld ? old('tanggal_mulai') : $tanggal_mulai ?? '' }}">
                            @if ($useOld)
                                @error('tanggal_mulai')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            @endif
                        </div>

                        {{-- Tanggal Selesai --}}
                        <div class="form-group mb-2">
                            <label for="tanggal_selesai_{{ $uniqueId }}" class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="tanggal_selesai_{{ $uniqueId }}"
                                name="tanggal_selesai"
                                value="{{ $useOld ? old('tanggal_selesai') : $tanggal_selesai ?? '' }}">
                            @if ($useOld)
                                @error('tanggal_selesai')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            @endif
                        </div>

                        {{-- Status --}}
                        <div class="form-group mb-2">
                            <label for="is_active_{{ $uniqueId }}" class="form-label">Status</label>
                            <select class="form-select" id="is_active_{{ $uniqueId }}" name="is_active">
                                <option value="">-- Pilih Status --</option>
                                <option value="1"
                                    {{ $statusValue === true || $statusValue === '1' || $statusValue === 1 ? 'selected' : '' }}>
                                    Aktif
                                </option>
                                <option value="0"
                                    {{ $statusValue === false || $statusValue === '0' || $statusValue === 0 ? 'selected' : '' }}>
                                    Tidak Aktif
                                </option>
                            </select>
                            @if ($useOld)
                                @error('is_active')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            @endif
                        </div>
                    </div>

                    {{-- Modal Footer --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
