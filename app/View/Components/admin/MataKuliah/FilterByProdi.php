<?php

namespace App\View\Components\admin\MataKuliah;

use App\Models\Admin\Prodi;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class FilterByProdi extends Component
{
    /**
     * Create a new component instance.
     */
    public Collection $prodi;
    public function __construct()
    {
        $this->prodi = Prodi::where('is_active', true)->with('fakultas')->orderBy('nama_prodi')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.mata-kuliah.filter-by-prodi');
    }
}
