<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreKelasRequest;
use App\Http\Requests\Admin\UpdateKelasRequest;
use App\Models\Admin\Kelas;
use App\Models\Admin\MataKuliah;
use App\Models\Admin\TahunAkademik;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public $pageTitle = 'Kelas';

    public function index()
    {
        $pageTitle = $this->pageTitle;

        $perPage = request()->query('perPage', 10);
        if (!in_array($perPage, [10, 25, 30, 100])) {
            $perPage = 10;
        }

        $query = Kelas::with(['mataKuliah', 'tahunAkademik']);

        $search = request()->query('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_kelas', 'like', "%{$search}%")
                    ->orWhere('nama_kelas', 'like', "%{$search}%");
            });
        }

        $mataKuliahId = request()->query('mata_kuliah_id');
        if ($mataKuliahId) {
            $query->where('mata_kuliah_id', $mataKuliahId);
        }

        $tahunAkademikId = request()->query('tahun_akademik_id');
        if ($tahunAkademikId) {
            $query->where('tahun_akademik_id', $tahunAkademikId);
        }

        $status = request()->query('status');
        if ($status && in_array($status, ['draft', 'aktif', 'selesai', 'nonaktif'], true)) {
            $query->where('status', $status);
        }

        $kelas = $query
            ->orderByDesc('created_at')
            ->paginate($perPage)
            ->appends(request()->query());

        $mataKuliah = MataKuliah::query()
            ->where('is_active', true)
            ->orderBy('nama_mata_kuliah')
            ->get();

        $tahunAkademik = TahunAkademik::query()
            ->orderByDesc('tanggal_mulai')
            ->get();

        confirmDelete('Hapus Kelas', 'Apakah Anda yakin ingin menghapus kelas ini? Tindakan ini tidak dapat dibatalkan.');
        return view('admin.kelas.index', compact('kelas', 'mataKuliah', 'tahunAkademik', 'pageTitle'));
    }

    public function store(StoreKelasRequest $request)
    {
        Kelas::create([
            'mata_kuliah_id'   => $request->mata_kuliah_id,
            'tahun_akademik_id' => $request->tahun_akademik_id,
            'kode_kelas'       => $request->kode_kelas,
            'nama_kelas'       => $request->nama_kelas,
            'kuota'            => $request->kuota,
            'deskripsi'        => $request->deskripsi,
            'status'           => $request->status,
        ]);

        toast()->success('Kelas berhasil ditambahkan.');
        return redirect()->route('admin.kelas.index');
    }

    public function update(UpdateKelasRequest $request, Kelas $kelas)
    {
        $kelas->mata_kuliah_id = $request->mata_kuliah_id;
        $kelas->tahun_akademik_id = $request->tahun_akademik_id;
        $kelas->kode_kelas = $request->kode_kelas;
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->kuota = $request->kuota;
        $kelas->deskripsi = $request->deskripsi;
        $kelas->status = $request->status;

        $kelas->save();

        toast()->success('Kelas berhasil diperbarui.');
        return redirect()->route('admin.kelas.index');
    }
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        toast()->success('Kelas berhasil dihapus.');
        return redirect()->route('admin.kelas.index');
    }
}
