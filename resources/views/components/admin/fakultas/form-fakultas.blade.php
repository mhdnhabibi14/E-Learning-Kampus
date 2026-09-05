@php
    $uniqueId = $id ?? 'new';
    $modalId = 'formFakultas' . $uniqueId;

    // Hanya gunakan old() pada modal yang sedang mengalami validasi error.
    $useOld = session('open_modal') === $modalId;
    $statusValue = $useOld ? old('is_active') : $is_active;
@endphp

<div>
    {{-- Button trigger modal --}}
    <button type="button" class="btn btn-sm {{ $id ? 'btn-primary btn-icon' : 'btn-dark' }}" data-bs-toggle="modal"
        data-bs-target="#{{ $modalId }}">
        @if ($id)
            <i class="bi bi-pencil-square"></i>
        @else
            <span class="d-flex align-items-center gap-2">
                <i class="bi bi-plus-lg"></i>
                Fakultas Baru
            </span>
        @endif
    </button>

    {{-- Modal --}}
    <div class="modal fade" id="{{ $modalId }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="formFakultasLabel{{ $uniqueId }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ $action }}" method="POST">
                    @csrf
                    @if ($id)
                        @method('PUT')
                    @endif
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="formFakultasLabel{{ $uniqueId }}">Form Fakultas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- Kode Fakultas --}}
                        <div class="form-group mb-2">
                            <label for="kode_fakultas_{{ $uniqueId }}" class="form-label">Kode Fakultas</label>
                            <input type="text" class="form-control" id="kode_fakultas_{{ $uniqueId }}"
                                name="kode_fakultas"
                                value="{{ $useOld ? old('kode_fakultas') : $kode_fakultas ?? '' }}">
                            @if ($useOld)
                                @error('kode_fakultas')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            @endif
                        </div>

                        {{-- Nama Fakultas --}}
                        <div class="form-group mb-2">
                            <label for="nama_fakultas_{{ $uniqueId }}" class="form-label">Nama Fakultas</label>
                            <input type="text" class="form-control" id="nama_fakultas_{{ $uniqueId }}"
                                name="nama_fakultas"
                                value="{{ $useOld ? old('nama_fakultas') : $nama_fakultas ?? '' }}">
                            @if ($useOld)
                                @error('nama_fakultas')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            @endif
                        </div>

                        {{-- Deskripsi --}}
                        <div class="form-group mb-2">
                            <label for="deskripsi_{{ $uniqueId }}" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi_{{ $uniqueId }}" name="deskripsi" rows="3">{{ $useOld ? old('deskripsi') : $deskripsi ?? '' }}</textarea>
                            @if ($useOld)
                                @error('deskripsi')
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

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
