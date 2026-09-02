<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public $pageTitle = 'Fakultas';

    public function index()
    {
        $pageTitle = $this->pageTitle;
        $fakultas = Fakultas::latest()->paginate(10);
        return view('admin.fakultas.index', compact('fakultas', 'pageTitle'));
    }

    public function create()
    {
        return view('admin.fakultas.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Fakultas $fakultas)
    {
        return view('admin.fakultas.show', compact('fakultas'));
    }

    public function edit(Fakultas $fakultas)
    {
        return view('admin.fakultas.edit', compact('fakultas'));
    }

    public function update(Request $request, Fakultas $fakultas)
    {
        //
    }

    public function destroy(Fakultas $fakultas)
    {
        $fakultas->delete();

        return redirect()
            ->route('admin.fakultas.index')
            ->with('success', 'Fakultas berhasil dihapus.');
    }
}
