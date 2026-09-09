<?php

namespace App\View\Components\admin\Prodi;

use App\Models\Admin\Fakultas;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class FilterByFakultas extends Component
{
    /**
     * Create a new component instance.
     */
    public Collection $fakultas;
    public function __construct()
    {
        $this->fakultas = Fakultas::where('is_active', true)
            ->orderBy('nama_fakultas')
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.prodi.filter-by-fakultas');
    }
}
