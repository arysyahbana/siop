<?php

namespace App\Http\Controllers;

use App\Exports\GenericExport;
use App\Helpers\GlobalFunction;
use App\Models\Kategori;
use App\Models\ObjekWisata;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Finder\Glob;

class ObjekWisataController extends Controller
{
    protected $path;
    public function __construct()
    {
        $this->path = 'objek-wisata/';
    }
    private function validateData(Request $request, $imageRule = 'required')
    {
        return $request->validate(
            [
                'namawisata' => 'required',
                'kategori_id' => 'required',
                'deskripsi' => 'required',
                'lokasi' => 'required',
                'harga' => 'required|numeric',
                'kontak' => 'required|numeric',
                'image' => $imageRule.'|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
        $image = GlobalFunction::saveImage($request->file('image'), $request->namawisata, $this->path);
        $data = [
            'nama_wisata' => $request->namawisata,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'harga' => $request->harga,
            'no_hp' => GlobalFunction::formatPhoneNumber($request->kontak),
            'id_kategori' => $request->kategori_id,
            'image' => $image,
        ];
        ObjekWisata::create($data);

        return back()->with('success', 'Objek Pariwisata Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $this->validateData($request,'sometimes');

        $wisata = ObjekWisata::find($id);

        $data = [
            'nama_wisata' => $request->namawisata,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'harga' => $request->harga,
            'no_hp' => GlobalFunction::formatPhoneNumber($request->kontak),
            'id_kategori' => $request->kategori_id,
        ];

        if ($request->file('image')) {
            GlobalFunction::deleteImage($wisata->image, $this->path);
            $data['image'] = GlobalFunction::saveImage($request->file('image'), $request->namawisata, $this->path);
        }

        ObjekWisata::where('id', $id)->update($data);

        return back()->with('success', 'Objek Pariwisata Berhasil Diubah');
    }

    public function destroy($id)
    {
        $wisata = ObjekWisata::find($id);
        GlobalFunction::deleteImage($wisata->image, $this->path);
        $wisata->delete();
        return back()->with('success', 'Objek Pariwisata Berhasil Dihapus');
    }

    public function download()
    {
        $columns = ['nama_wisata', 'deskripsi', 'lokasi', 'image', 'harga','no_hp'];

        $relations = [
            'rKategori' => ['kategori'],
        ];

        return Excel::download(new GenericExport(ObjekWisata::class, $columns, 'H', 'objek-wisata', $relations), 'Objek Wisata.xlsx');
    }
}
