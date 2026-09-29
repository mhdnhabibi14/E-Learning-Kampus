<?php

namespace App\View\Components\admin\kelas;

use App\Models\Admin\Kelas;
use App\Models\Admin\MataKuliah;
use App\Models\Admin\TahunAkademik;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class FormKelas extends Component
{
    /**
     * Create a new component instance.
     */
    public ?int $id = null;
    public ?int $mata_kuliah_id = null;
    public ?int $tahun_akademik_id = null;
    public ?string $kode_kelas = null;
    public ?string $nama_kelas = null;
    public ?int $kuota = null;
    public ?string $deskripsi = null;
    public ?string $status = null;

    public Collection $mataKuliah;
    public Collection $tahunAkademik;

    public string $action;

    public function __construct(?int $id = null)
    {
        $this->mataKuliah = MataKuliah::query()
            ->where('is_active', true)
            ->orderBy('nama_mata_kuliah')
            ->get();

        $this->tahunAkademik = TahunAkademik::query()
            ->orderByDesc('tanggal_mulai')
            ->get();

        if ($id) {
            $kelas = Kelas::findOrFail($id);

            $this->id = $kelas->id;
            $this->mata_kuliah_id = $kelas->mata_kuliah_id;
            $this->tahun_akademik_id = $kelas->tahun_akademik_id;
            $this->kode_kelas = $kelas->kode_kelas;
            $this->nama_kelas = $kelas->nama_kelas;
            $this->kuota = $kelas->kuota;
            $this->deskripsi = $kelas->deskripsi;
            $this->status = $kelas->status;

            $this->action = route(
                'admin.kelas.update',
                $kelas->id
            );
        } else {
            $this->action = route('admin.kelas.store');

            // Default status ketika membuat kelas baru.
            $this->status = 'draft';
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.kelas.form-kelas');
    }
}
