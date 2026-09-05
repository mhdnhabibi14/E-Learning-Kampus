<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFakultasRequest;
use App\Http\Requests\UpdateFakultasRequest;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public $pageTitle = 'Fakultas';

    public function index()
    {
        $pageTitle = $this->pageTitle;
        $query = Fakultas::query();
        $fakultas = $query->paginate(10);
        confirmDelete('Hapus Fakultas', 'Apakah Anda yakin ingin menghapus fakultas ini? Tindakan ini tidak dapat dibatalkan.');
        return view('admin.fakultas.index', compact('fakultas', 'pageTitle'));
    }

    public function store(StoreFakultasRequest $request)
    {
        Fakultas::create([
            'kode_fakultas' => $request->kode_fakultas,
            'nama_fakultas' => $request->nama_fakultas,
            'deskripsi'     => $request->deskripsi,
            'is_active'     => $request->is_active,
        ]);

        toast()->success('Fakultas berhasil ditambahkan.');
        return redirect()->route('admin.fakultas.index');
    }

    public function update(UpdateFakultasRequest $request, Fakultas $fakultas)
    {
        $fakultas->kode_fakultas = $request->kode_fakultas;
        $fakultas->nama_fakultas = $request->nama_fakultas;
        $fakultas->deskripsi = $request->deskripsi;
        $fakultas->is_active = $request->is_active;
        $fakultas->save();
        toast()->success('Fakultas berhasil diperbarui.');
        return redirect()->route('admin.fakultas.index');
    }

    public function destroy(Fakultas $fakultas)
    {
        $fakultas->delete();
        toast()->success('Fakultas berhasil dihapus.');
        return redirect()->route('admin.fakultas.index');
    }
}
