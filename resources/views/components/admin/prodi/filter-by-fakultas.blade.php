<div>
    <select name="fakultas_id" id="fakultas_id" class="form-select form-select-sm" onchange="this.form.submit()">
        <option value="">Semua Fakultas</option>

        @foreach ($fakultas as $item)
            <option value="{{ $item->id }}" {{ request('fakultas_id') == $item->id ? 'selected' : '' }}>
                {{ $item->nama_fakultas }}
            </option>
        @endforeach
    </select>
</div>
