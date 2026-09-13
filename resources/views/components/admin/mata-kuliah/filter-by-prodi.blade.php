<div>
    <select name="program_studi_id" id="program_studi_id" class="form-select form-select-sm" onchange="this.form.submit()">
        <option value="">Semua Program Studi</option>
        @foreach ($prodi as $item)
            <option value="{{ $item->id }}" {{ request('program_studi_id') == $item->id ? 'selected' : '' }}>
                {{ $item->nama_prodi }}
            </option>
        @endforeach
    </select>
</div>
