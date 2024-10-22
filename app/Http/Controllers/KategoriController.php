<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    private function validateData(Request $request)
    {
        return $request->validate(
            [
                'kategori' => 'required',
            ],
            [
                'kategori.required' => 'kategori tidak boleh kosong',
            ],
        );
    }

    public function index()
    {
        $page = 'Kategori';
        $kategori = Kategori::all();
        return view('admin.pages.Kategori.index', compact('page', 'kategori'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        Kategori::create($data);
        return back()->with('success', 'Data kategori berhasil ditambahkan.');
    }

    public function update(Request $request, $id){
        $data = $this->validateData($request);
        Kategori::find($id)->update($data);
        return back()->with('success', 'Data kategori berhasil diubah.');
    }

    public function destroy($id){
        Kategori::find($id)->delete();
        return back()->with('success', 'Data kategori berhasil dihapus.');
    }
}
