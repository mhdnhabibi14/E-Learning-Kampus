<div class="d-flex align-items-center gap-2">
    <span class="text-muted small text-nowrap">Tampilkan</span>
    <select name="perPage" id="perPage" class="form-select form-select-sm" style="width: 75px;"
        onchange="this.form.submit()">
        @foreach ($perPageOptions as $item)
            <option value="{{ $item }}" {{ request('perPage', 10) == $item ? 'selected' : '' }}>
                {{ $item }}
            </option>
        @endforeach
    </select>
    <span class="text-muted small text-nowrap">data</span>
</div>
