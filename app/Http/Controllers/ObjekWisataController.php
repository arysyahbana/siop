<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalFunction;
use App\Models\Kategori;
use App\Models\ObjekWisata;
use Illuminate\Http\Request;

class ObjekWisataController extends Controller
{
    private function validateData(Request $request)
    {
        return $request->validate(
            [
                'namawisata' => 'required',
                'kategori_id' => 'required',
                'deskripsi' => 'required',
                'lokasi' => 'required',
                'harga' => 'required|numeric',
                'kontak' => 'required|numeric',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'namawisata.required' => 'nama wisata tidak boleh kosong',
                'kategori_id.required' => 'kategori tidak boleh kosong',
                'deskripsi.required' => 'deskripsi tidak boleh kosong',
                'lokasi.required' => 'lokasi tidak boleh kosong',
                'harga.required' => 'harga tidak boleh kosong',
                'harga.numeric' => 'harga harus bernilai angka',
                'kontak.required' => 'kontak tidak boleh kosong',
                'kontak.required' => 'kontak harus bernilai angka',
                'image.required' => 'image tidak boleh kosong',
                'image.image' => 'image harus berupa gambar',
                'image.max' => 'image maksimal 2mb',
                'image.mimes' => 'image harus berupa jpeg,png,jpg,gif,svg',
            ],
        );
    }
    public function index()
    {
        $page = 'Objek Pariwisata';
        $wisata = ObjekWisata::with('rKategori')->get();
        $kategori = Kategori::all();
        return view('admin.pages.ObjekWisata.index', compact('page', 'wisata', 'kategori'));
    }

    public function store(Request $request)
    {
        $this->validateData($request);
        $image = GlobalFunction::saveImage($request->file('image'), $request->namawisata, 'objek-wisata/');
        $data = [
            'nama_wisata' => $request->namawisata,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'harga' => $request->harga,
            'no_hp' => $request->kontak,
            'id_kategori' => $request->kategori_id,
            'image' => $image,
        ];
        ObjekWisata::create($data);

        return back()->with('success', 'Objek Pariwisata Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
    }
}
