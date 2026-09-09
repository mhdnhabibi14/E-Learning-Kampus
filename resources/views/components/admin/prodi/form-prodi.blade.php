@php
    $uniqueId = $id ?? 'new';
    $modalId = 'formProdi' . $uniqueId;

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
                Program Studi Baru
            </span>
        @endif
    </button>

    {{-- Modal --}}
    <div class="modal fade" id="{{ $modalId }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="formProdiLabel{{ $uniqueId }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ $action }}" method="POST">
                    @csrf

                    @if ($id)
                        @method('PUT')
                    @endif

                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="formProdiLabel{{ $uniqueId }}">Form Program Studi
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        {{-- Fakultas --}}
                        <div class="form-group mb-2">
                            <label for="fakultas_id_{{ $uniqueId }}" class="form-label">Fakultas</label>
                            <select class="form-select" id="fakultas_id_{{ $uniqueId }}" name="fakultas_id">
                                <option value="">-- Pilih Fakultas --</option>
                                @foreach ($fakultas as $item)
                                    <option value="{{ $item->id }}"
                                        {{ ($useOld ? old('fakultas_id') : $fakultas_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_fakultas }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($useOld)
                                @error('fakultas_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            @endif
                        </div>

                        {{-- Kode Program Studi --}}
                        <div class="form-group mb-2">
                            <label for="kode_prodi_{{ $uniqueId }}" class="form-label">Kode Program Studi</label>
                            <input type="text" class="form-control" id="kode_prodi_{{ $uniqueId }}"
                                name="kode_prodi" value="{{ $useOld ? old('kode_prodi') : $kode_prodi ?? '' }}">
                            @if ($useOld)
                                @error('kode_prodi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            @endif
                        </div>

                        {{-- Nama Program Studi --}}
                        <div class="form-group mb-2">
                            <label for="nama_prodi_{{ $uniqueId }}" class="form-label">Nama Program Studi</label>
                            <input type="text" class="form-control" id="nama_prodi_{{ $uniqueId }}"
                                name="nama_prodi" value="{{ $useOld ? old('nama_prodi') : $nama_prodi ?? '' }}">
                            @if ($useOld)
                                @error('nama_prodi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            @endif
                        </div>

                        {{-- Jenjang --}}
                        <div class="form-group mb-2">
                            <label for="jenjang_{{ $uniqueId }}" class="form-label">Jenjang</label>
                            <select class="form-select" id="jenjang_{{ $uniqueId }}" name="jenjang">
                                <option value="">-- Pilih Jenjang --</option>
                                @foreach (['D3', 'D4', 'S1', 'S2', 'S3', 'Profesi'] as $item)
                                    <option value="{{ $item }}"
                                        {{ ($useOld ? old('jenjang') : $jenjang) === $item ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($useOld)
                                @error('jenjang')
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
