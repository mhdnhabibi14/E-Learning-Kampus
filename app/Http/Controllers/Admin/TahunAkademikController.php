<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTahunAkademikRequest;
use App\Http\Requests\Admin\UpdateTahunAkademikRequest;
use App\Models\Admin\TahunAkademik;
use Illuminate\Http\Request;

class TahunAkademikController extends Controller
{
    public $pageTitle = 'Tahun Akademik';

    public function index()
    {
        $pageTitle = $this->pageTitle;

        $perPage = request()->query('perPage', 10);
        if (!in_array($perPage, [10, 25, 30, 100])) {
            $perPage = 10;
        }

        $query = TahunAkademik::query();

        $search = request()->query('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_tahun_akademik', 'like', "%{$search}%")
                    ->orWhere('nama_tahun_akademik', 'like', "%{$search}%");
            });
        }

        $status = request()->query('status');
        if ($status === 'aktif') {
            $query->where('is_active', true);
        }
        if ($status === 'tidak_aktif') {
            $query->where('is_active', false);
        }

        $tahunAkademik = $query->orderByDesc('tanggal_mulai')->paginate($perPage)->appends(request()->query());
        confirmDelete('Hapus Tahun Akademik', 'Apakah Anda yakin ingin menghapus tahun akademik ini? Tindakan ini tidak dapat dibatalkan.');
        return view('admin.tahun-akademik.index', compact('tahunAkademik', 'pageTitle'));
    }

    public function store(StoreTahunAkademikRequest $request)
    {
        if (! empty($tahunAkademik['is_active'])) {
            TahunAkademik::where('is_active', true)
                ->update([
                    'is_active' => false,
                ]);
        }

        TahunAkademik::create([
            'kode_tahun_akademik'       => $request->kode_tahun_akademik,
            'nama_tahun_akademik'       => $request->nama_tahun_akademik,
            'semester'                  => $request->semester,
            'tanggal_mulai'             => $request->tanggal_mulai,
            'tanggal_selesai'           => $request->tanggal_selesai,
            'is_active'                 => $request->is_active,
        ]);

        toast()->success('Tahun Akademik berhasil ditambahkan.');
        return redirect()->route('admin.tahun-akademik.index');
    }

    public function update(UpdateTahunAkademikRequest $request, TahunAkademik $tahunAkademik)
    {
        if (! empty($tahunAkademik['is_active'])) {
            TahunAkademik::where('id', '!=', $tahunAkademik->id)
                ->where('is_active', true)
                ->update([
                    'is_active' => false,
                ]);
        }

        $tahunAkademik->kode_tahun_akademik = $request->kode_tahun_akademik;
        $tahunAkademik->nama_tahun_akademik = $request->nama_tahun_akademik;
        $tahunAkademik->semester            = $request->semester;
        $tahunAkademik->tanggal_mulai       = $request->tanggal_mulai;
        $tahunAkademik->tanggal_selesai     = $request->tanggal_selesai;
        $tahunAkademik->is_active           = $request->is_active;
        $tahunAkademik->save();

        toast()->success('Tahun Akademik berhasil diperbarui.');
        return redirect()->route('admin.tahun-akademik.index');
    }

    public function destroy(TahunAkademik $tahunAkademik)
    {
        $tahunAkademik->delete();
        toast()->success('Tahun Akademik berhasil dihapus.');
        return redirect()->route('admin.tahun-akademik.index');
    }
}
