<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMataKuliahRequest;
use App\Http\Requests\Admin\UpdateMataKuliahRequest;
use App\Models\Admin\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public $pageTitle = 'Mata Kuliah';

    public function index()
    {
        $pageTitle = $this->pageTitle;

        $perPage = request()->query('perPage', 10);
        if (!in_array($perPage, [10, 25, 50, 100])) {
            $perPage = 10;
        }

        $query = MataKuliah::with('programStudi.fakultas');

        $search = request()->query('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_mata_kuliah', 'like', "%{$search}%")
                    ->orWhere('nama_mata_kuliah', 'like', "%{$search}%");
            });
        }

        $programStudiId = request()->query('program_studi_id');
        if ($programStudiId) {
            $query->where('program_studi_id', $programStudiId);
        }

        $semester = request()->query('semester');
        if ($semester) {
            $query->where('semester', $semester);
        }

        $mataKuliah = $query->latest()->paginate($perPage)->appends(request()->query());
        confirmDelete('Hapus Mata Kuliah', 'Apakah Anda yakin ingin menghapus mata kuliah ini? Tindakan ini tidak dapat dibatalkan.');
        return view('admin.mata-kuliah.index', compact('mataKuliah', 'pageTitle'));
    }

    public function store(StoreMataKuliahRequest $request)
    {
        MataKuliah::create([
            'program_studi_id'      => $request->program_studi_id,
            'kode_mata_kuliah'      => $request->kode_mata_kuliah,
            'nama_mata_kuliah'      => $request->nama_mata_kuliah,
            'sks'                   => $request->sks,
            'semester'              => $request->semester,
            'deskripsi'             => $request->deskripsi,
            'is_active'             => $request->is_active,
        ]);

        toast()->success('Mata Kuliah berhasil ditambahkan.');
        return redirect()->route('admin.mata-kuliah.index');
    }

    public function update(UpdateMataKuliahRequest $request, MataKuliah $mataKuliah)
    {
        $mataKuliah->program_studi_id = $request->program_studi_id;
        $mataKuliah->kode_mata_kuliah = $request->kode_mata_kuliah;
        $mataKuliah->nama_mata_kuliah = $request->nama_mata_kuliah;
        $mataKuliah->sks              = $request->sks;
        $mataKuliah->semester         = $request->semester;
        $mataKuliah->deskripsi        = $request->deskripsi;
        $mataKuliah->is_active        = $request->is_active;
        $mataKuliah->save();

        toast()->success('Mata Kuliah berhasil diperbarui.');
        return redirect()->route('admin.mata-kuliah.index');
    }

    public function destroy(MataKuliah $mataKuliah)
    {
        $mataKuliah->delete();
        toast()->success('Mata Kuliah berhasil dihapus.');
        return redirect()->route('admin.mata-kuliah.index');
    }
}
