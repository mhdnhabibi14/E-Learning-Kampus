<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProdiRequest;
use App\Http\Requests\Admin\UpdateProdiRequest;
use App\Models\Admin\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public $pageTitle = 'Program Studi';

    public function index()
    {
        $pageTitle = $this->pageTitle;
        $perPage = request()->query('perPage', 10);

        if (!in_array($perPage, [10, 25, 50, 100])) {
            $perPage = 10;
        }

        $query = Prodi::with('fakultas');

        $search = request()->query('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_prodi', 'like', "%{$search}%")
                    ->orWhere('nama_prodi', 'like', "%{$search}%");
            });
        }

        $prodi = $query->latest()->paginate($perPage)->appends(request()->query());
        confirmDelete('Hapus Program Studi', 'Apakah Anda yakin ingin menghapus program studi ini? Tindakan ini tidak dapat dibatalkan.');
        return view('admin.prodi.index', compact('prodi', 'pageTitle'));
    }

    public function store(StoreProdiRequest $request)
    {
        Prodi::create([
            'fakultas_id'   => $request->fakultas_id,
            'kode_prodi'    => $request->kode_prodi,
            'nama_prodi'    => $request->nama_prodi,
            'jenjang'       => $request->jenjang,
            'deskripsi'     => $request->deskripsi,
            'is_active'     => $request->is_active,
        ]);

        toast()->success('Program Studi berhasil ditambahkan.');
        return redirect()->route('admin.prodi.index');
    }

    public function update(UpdateProdiRequest $request, Prodi $prodi)
    {
        $prodi->fakultas_id = $request->fakultas_id;
        $prodi->kode_prodi = $request->kode_prodi;
        $prodi->nama_prodi = $request->nama_prodi;
        $prodi->jenjang = $request->jenjang;
        $prodi->deskripsi = $request->deskripsi;
        $prodi->is_active = $request->is_active;
        $prodi->save();

        toast()->success('Program Studi berhasil diperbarui.');
        return redirect()->route('admin.prodi.index');
    }

    public function destroy(Prodi $prodi)
    {
        $prodi->delete();
        toast()->success('Program Studi berhasil dihapus.');
        return redirect()->route('admin.prodi.index');
    }
}
