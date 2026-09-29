@php
    $uniqueId = $id ?? 'new';
    $modalId = 'formKelas' . $uniqueId;

    // Hanya gunakan old() pada modal yang sedang mengalami validasi error.
    $useOld = session('open_modal') === $modalId;

    $mataKuliahValue = $useOld ? old('mata_kuliah_id') : $mata_kuliah_id;
    $tahunAkademikValue = $useOld ? old('tahun_akademik_id') : $tahun_akademik_id;
    $statusValue = $useOld ? old('status') : $status;
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
                Kelas Baru
            </span>
        @endif
    </button>

    {{-- Modal --}}
    <div class="modal fade" id="{{ $modalId }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="formKelasLabel{{ $uniqueId }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{ $action }}" method="POST">
                    @csrf

                    @if ($id)
                        @method('PUT')
                    @endif

                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="formKelasLabel{{ $uniqueId }}">
                            Form Kelas
                        </h1>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        {{-- Mata Kuliah --}}
                        <div class="form-group mb-2">
                            <label for="mata_kuliah_id_{{ $uniqueId }}" class="form-label">
                                Mata Kuliah
                            </label>

                            <select class="form-select" id="mata_kuliah_id_{{ $uniqueId }}" name="mata_kuliah_id">
                                <option value="">-- Pilih Mata Kuliah --</option>

                                @foreach ($mataKuliah as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $mataKuliahValue == $item->id ? 'selected' : '' }}>
                                        {{ $item->kode_mata_kuliah }} -
                                        {{ $item->nama_mata_kuliah }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($useOld)
                                @error('mata_kuliah_id')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            @endif
                        </div>

                        {{-- Tahun Akademik --}}
                        <div class="form-group mb-2">
                            <label for="tahun_akademik_id_{{ $uniqueId }}" class="form-label">
                                Tahun Akademik
                            </label>

                            <select class="form-select" id="tahun_akademik_id_{{ $uniqueId }}"
                                name="tahun_akademik_id">
                                <option value="">
                                    -- Pilih Tahun Akademik --
                                </option>

                                @foreach ($tahunAkademik as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $tahunAkademikValue == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_tahun_akademik }}
                                        - {{ $item->semester }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($useOld)
                                @error('tahun_akademik_id')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            @endif
                        </div>

                        {{-- Kode Kelas --}}
                        <div class="form-group mb-2">
                            <label for="kode_kelas_{{ $uniqueId }}" class="form-label">
                                Kode Kelas
                            </label>

                            <input type="text" class="form-control" id="kode_kelas_{{ $uniqueId }}"
                                name="kode_kelas" value="{{ $useOld ? old('kode_kelas') : $kode_kelas ?? '' }}"
                                maxlength="20" placeholder="Contoh: TI-4A">

                            @if ($useOld)
                                @error('kode_kelas')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            @endif
                        </div>

                        {{-- Nama Kelas --}}
                        <div class="form-group mb-2">
                            <label for="nama_kelas_{{ $uniqueId }}" class="form-label">
                                Nama Kelas
                            </label>

                            <input type="text" class="form-control" id="nama_kelas_{{ $uniqueId }}"
                                name="nama_kelas" value="{{ $useOld ? old('nama_kelas') : $nama_kelas ?? '' }}"
                                maxlength="100" placeholder="Contoh: TI 4A">

                            @if ($useOld)
                                @error('nama_kelas')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            @endif
                        </div>

                        {{-- Kuota --}}
                        <div class="form-group mb-2">
                            <label for="kuota_{{ $uniqueId }}" class="form-label">
                                Kuota
                            </label>

                            <input type="number" class="form-control" id="kuota_{{ $uniqueId }}" name="kuota"
                                value="{{ $useOld ? old('kuota') : $kuota ?? '' }}" min="1"
                                placeholder="Contoh: 30">

                            @if ($useOld)
                                @error('kuota')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            @endif
                        </div>

                        {{-- Deskripsi --}}
                        <div class="form-group mb-2">
                            <label for="deskripsi_{{ $uniqueId }}" class="form-label">
                                Deskripsi
                            </label>

                            <textarea class="form-control" id="deskripsi_{{ $uniqueId }}" name="deskripsi" rows="3"
                                placeholder="Masukkan deskripsi kelas">{{ $useOld ? old('deskripsi') : $deskripsi ?? '' }}</textarea>

                            @if ($useOld)
                                @error('deskripsi')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            @endif
                        </div>

                        {{-- Status --}}
                        <div class="form-group mb-2">
                            <label for="status_{{ $uniqueId }}" class="form-label">
                                Status
                            </label>

                            <select class="form-select" id="status_{{ $uniqueId }}" name="status">
                                <option value="">-- Pilih Status --</option>

                                <option value="draft" {{ $statusValue === 'draft' ? 'selected' : '' }}>
                                    Draft
                                </option>

                                <option value="aktif" {{ $statusValue === 'aktif' ? 'selected' : '' }}>
                                    Aktif
                                </option>

                                <option value="selesai" {{ $statusValue === 'selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>

                                <option value="nonaktif" {{ $statusValue === 'nonaktif' ? 'selected' : '' }}>
                                    Nonaktif
                                </option>
                            </select>

                            @if ($useOld)
                                @error('status')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            @endif
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
