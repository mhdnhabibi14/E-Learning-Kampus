@props(['route'])
<div class="d-flex justify-content-end">
    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.location.href='{{ route($route) }}'"
        title="Reset Filter">
        <i class="bi bi-arrow-clockwise"></i>
        <span class="d-none d-lg-inline ms-1">Reset</span>
    </button>
</div>
