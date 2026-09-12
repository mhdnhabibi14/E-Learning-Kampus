<?php

namespace App\View\Components\admin\MataKuliah;

use App\Models\Admin\MataKuliah;
use App\Models\Admin\Prodi;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class FormMataKuliah extends Component
{
    /**
     * Create a new component instance.
     */
    public ?int $id = null;
    public ?int $program_studi_id = null;
    public ?string $kode_mata_kuliah = null;
    public ?string $nama_mata_kuliah = null;
    public ?int $sks = null;
    public ?int $semester = null;
    public ?string $deskripsi = null;
    public bool|int|null $is_active = null;
    public string $action;
    public Collection $programStudi;
    public function __construct(?int $id = null)
    {
        $this->programStudi = Prodi::where('is_active', true)
            ->with('fakultas')->orderBy('nama_prodi')
            ->get();

        if ($id) {
            $mataKuliah = MataKuliah::findOrFail($id);

            $this->id = $mataKuliah->id;
            $this->program_studi_id = $mataKuliah->program_studi_id;
            $this->kode_mata_kuliah = $mataKuliah->kode_mata_kuliah;
            $this->nama_mata_kuliah = $mataKuliah->nama_mata_kuliah;
            $this->sks              = $mataKuliah->sks;
            $this->semester         = $mataKuliah->semester;
            $this->deskripsi        = $mataKuliah->deskripsi;
            $this->is_active        = $mataKuliah->is_active;
            $this->action = route('admin.mata-kuliah.update', $mataKuliah->id);
        } else {
            $this->action = route('admin.mata-kuliah.store');
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.mata-kuliah.form-mata-kuliah');
    }
}
