<div class="position-relative">
    <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
    <input type="text" name="{{ $term }}" id="{{ $term }}" class="form-control form-control-sm ps-5"
        placeholder="{{ $placeholder }}" value="{{ request($term) }}"
        onkeydown="if(event.key === 'Enter'){ this.form.submit(); }">
</div>
