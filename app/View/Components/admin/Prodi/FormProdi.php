<?php

namespace App\View\Components\Admin\Prodi;

use App\Models\Admin\Fakultas;
use App\Models\Admin\Prodi;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class FormProdi extends Component
{
    /**
     * Create a new component instance.
     */
    public ?int $id = null;
    public ?int $fakultas_id = null;
    public ?string $kode_prodi = null;
    public ?string $nama_prodi = null;
    public ?string $jenjang = null;
    public ?string $deskripsi = null;
    public bool|int|null $is_active = null;
    public string $action;
    public Collection $fakultas;

    public function __construct(?int $id = null)
    {
        $this->fakultas = Fakultas::where('is_active', true)
            ->orderBy('nama_fakultas')
            ->get();

        if ($id) {
            $prodi = Prodi::findOrFail($id);

            $this->id = $prodi->id;
            $this->fakultas_id = $prodi->fakultas_id;
            $this->kode_prodi = $prodi->kode_prodi;
            $this->nama_prodi = $prodi->nama_prodi;
            $this->jenjang = $prodi->jenjang;
            $this->deskripsi = $prodi->deskripsi;
            $this->is_active = $prodi->is_active;
            $this->action = route('admin.prodi.update', $prodi->id);
        } else {
            $this->action = route('admin.prodi.store');
        }
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.prodi.form-prodi');
    }
}
