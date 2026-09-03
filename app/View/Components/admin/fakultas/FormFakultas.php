<?php

namespace App\View\Components\admin\fakultas;

use App\Models\Fakultas;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormFakultas extends Component
{
    /**
     * Create a new component instance.
     */
    public ?int $id = null;
    public ?string $kode_fakultas = null;
    public ?string $nama_fakultas = null;
    public ?string $deskripsi = null;
    public bool|int|null $is_active = null;
    public string $action;
    public function __construct(?int $id = null)
    {
        if ($id) {
            $fakultas = Fakultas::findOrFail($id);
            $this->id = $fakultas->id;
            $this->kode_fakultas = $fakultas->kode_fakultas;
            $this->nama_fakultas = $fakultas->nama_fakultas;
            $this->deskripsi = $fakultas->deskripsi;
            $this->is_active = $fakultas->is_active;
            $this->action = route('admin.fakultas.update', $fakultas->id);
        } else {
            $this->action = route('admin.fakultas.store');
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.fakultas.form-fakultas');
    }
}
