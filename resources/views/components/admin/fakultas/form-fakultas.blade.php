<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-sm {{ $id ? 'btn-primary btn icon' : 'btn-dark' }}" data-bs-toggle="modal"
        data-bs-target="#formFakultas{{ $id ?? '' }}">
        @if ($id)
            <i class="bi bi-pencil-square"></i>
        @else
            <span class="d-flex align-items-center gap-2">
                <i class="bi bi-plus-lg"></i>
                Fakultas Baru
            </span>
        @endif
    </button>

    <!-- Modal -->
    <div class="modal fade" id="formFakultas{{ $id ?? '' }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="formFakultasLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ $action }}" method="POST">
                    @csrf
                    @if ($id)
                        @method('PUT')
                    @endif
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="formFakultasLabel">Form Fakultas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="kode_fakultas" class="form-label">Kode Fakultas</label>
                            <input type="text" class="form-control" id="kode_fakultas" name="kode_fakultas"
                                value="{{ old('kode_fakultas', $kode_fakultas ?? '') }}">
                            @error('kode_fakultas')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="nama_fakultas" class="form-label">Nama Fakultas</label>
                            <input type="text" class="form-control" id="nama_fakultas" name="nama_fakultas"
                                value="{{ old('nama_fakultas', $nama_fakultas ?? '') }}">
                            @error('nama_fakultas')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $deskripsi ?? '') }}</textarea>
                            @error('deskripsi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="is_active" class="form-label">Status</label>
                            <select class="form-select" id="is_active" name="is_active">
                                <option value="">-- Pilih Status --</option>
                                <option value="1" {{ old('is_active', $is_active ?? '') == 1 ? 'selected' : '' }}>
                                    Aktif
                                </option>
                                <option value="0" {{ old('is_active', $is_active ?? '') == 0 ? 'selected' : '' }}>
                                    Tidak
                                    Aktif</option>
                            </select>
                            @error('is_active')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
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
