<div>
    <select name="semester" id="semester" class="form-select form-select-sm" onchange="this.form.submit()">
        <option value="">Semua Semester</option>

        @for ($i = 1; $i <= 14; $i++)
            <option value="{{ $i }}" {{ request('semester') == $i ? 'selected' : '' }}>
                Semester {{ $i }}
            </option>
        @endfor
    </select>
</div>
