@php
    $selectedSemester = request($term);
@endphp

<select name="{{ $term }}" class="form-select form-select-sm" onchange="this.form.submit()">
    <option value="">Semua Semester</option>
    <option value="Ganjil" {{ $selectedSemester === 'Ganjil' ? 'selected' : '' }}>
        Ganjil
    </option>
    <option value="Genap" {{ $selectedSemester === 'Genap' ? 'selected' : '' }}>
        Genap
    </option>
</select>
