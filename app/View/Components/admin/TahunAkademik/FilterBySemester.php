<?php

namespace App\View\Components\admin\TahunAkademik;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilterBySemester extends Component
{
    /**
     * Create a new component instance.
     */
    public string $term;
    public function __construct(string $term = 'semester')
    {
        $this->term = $term;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.tahun-akademik.filter-by-semester');
    }
}
