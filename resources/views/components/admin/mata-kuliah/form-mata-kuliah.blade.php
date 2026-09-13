@php
    $uniqueId = $id ?? 'new';
    $modalId = 'formMataKuliah' . $uniqueId;

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
                Mata Kuliah Baru
            </span>
        @endif
    </button>

    {{-- Modal --}}
    <div class="modal fade" id="{{ $modalId }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="formMataKuliahLabel{{ $uniqueId }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ $action }}" method="POST">
                    @csrf
                    @if ($id)
                        @method('PUT')
                    @endif
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="formMataKuliahLabel{{ $uniqueId }}">Form Mata Kuliah</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        {{-- Program Studi --}}
                        <div class="form-group mb-2">
                            <label for="program_studi_id_{{ $uniqueId }}" class="form-label">
                                Program Studi
                            </label>
                            <select class="form-select" id="program_studi_id_{{ $uniqueId }}"
                                name="program_studi_id">
                                <option value="">
                                    -- Pilih Program Studi --
                                </option>
                                @foreach ($programStudi as $item)
                                    <option value="{{ $item->id }}"
                                        {{ ($useOld ? old('program_studi_id') : $program_studi_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_prodi }} —
                                        {{ $item->fakultas->nama_fakultas }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($useOld)
                                @error('program_studi_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            @endif
                        </div>

                        {{-- Kode Mata Kuliah --}}
                        <div class="form-group mb-2">
                            <label for="kode_mata_kuliah_{{ $uniqueId }}" class="form-label">Kode Mata
                                Kuliah</label>
                            <input type="text" class="form-control" id="kode_mata_kuliah_{{ $uniqueId }}"
                                name="kode_mata_kuliah"
                                value="{{ $useOld ? old('kode_mata_kuliah') : $kode_mata_kuliah ?? '' }}">
                            @if ($useOld)
                                @error('kode_mata_kuliah')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            @endif
                        </div>

                        {{-- Nama Mata Kuliah --}}
                        <div class="form-group mb-2">
                            <label for="nama_mata_kuliah_{{ $uniqueId }}" class="form-label">Nama Mata
                                Kuliah</label>
                            <input type="text" class="form-control" id="nama_mata_kuliah_{{ $uniqueId }}"
                                name="nama_mata_kuliah"
                                value="{{ $useOld ? old('nama_mata_kuliah') : $nama_mata_kuliah ?? '' }}">
                            @if ($useOld)
                                @error('nama_mata_kuliah')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            @endif
                        </div>

                        {{-- SKS --}}
                        <div class="form-group mb-2">
                            <label for="sks_{{ $uniqueId }}" class="form-label">SKS</label>
                            <input type="number" class="form-control" id="sks_{{ $uniqueId }}" name="sks"
                                min="1" max="6" value="{{ $useOld ? old('sks') : $sks ?? '' }}">
                            @if ($useOld)
                                @error('sks')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            @endif
                        </div>

                        {{-- Semester --}}
                        <div class="form-group mb-2">
                            <label for="semester_{{ $uniqueId }}" class="form-label">Semester</label>
                            <select class="form-select" id="semester_{{ $uniqueId }}" name="semester">
                                <option value="">-- Pilih Semester --</option>
                                @for ($i = 1; $i <= 14; $i++)
                                    <option value="{{ $i }}"
                                        {{ ($useOld ? old('semester') : $semester) == $i ? 'selected' : '' }}>Semester
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            @if ($useOld)
                                @error('semester')
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
