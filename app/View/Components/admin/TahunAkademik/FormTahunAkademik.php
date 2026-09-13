<?php

namespace App\View\Components\admin\TahunAkademik;

use App\Models\Admin\TahunAkademik;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormTahunAkademik extends Component
{
    /**
     * Create a new component instance.
     */
    public ?int $id = null;
    public ?string $kode_tahun_akademik = null;
    public ?string $nama_tahun_akademik = null;
    public ?string $semester = null;
    public ?string $tanggal_mulai = null;
    public ?string $tanggal_selesai = null;
    public bool|int|null $is_active = null;
    public string $action;

    public function __construct(?int $id = null)
    {
        if ($id) {
            $tahunAkademik = TahunAkademik::findOrFail($id);

            $this->id = $tahunAkademik->id;
            $this->kode_tahun_akademik = $tahunAkademik->kode_tahun_akademik;
            $this->nama_tahun_akademik = $tahunAkademik->nama_tahun_akademik;
            $this->semester = $tahunAkademik->semester;
            $this->tanggal_mulai = $tahunAkademik->tanggal_mulai?->format('Y-m-d');
            $this->tanggal_selesai = $tahunAkademik->tanggal_selesai?->format('Y-m-d');
            $this->is_active = $tahunAkademik->is_active;

            $this->action = route('admin.tahun-akademik.update', $tahunAkademik->id);
        } else {
            $this->action = route('admin.tahun-akademik.store');
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.tahun-akademik.form-tahun-akademik');
    }
}
