<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalFunction;
use App\Models\Kamar;
use App\Models\Penginapan;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    protected $path;
    public function __construct()
    {
        $this->path = 'kamar/';
    }
    private function validateData(Request $request, $imageRule = 'required')
    {
        return $request->validate(
            [
                'nomorKamar' => 'required',
                'penginapan_id' => 'required',
                'status' => 'required',
                'hargaKamar' => 'required|numeric',
                'image' => $imageRule . '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'nomorKamar.required' => 'Nomor Kamar tidak boleh kosong',
                'penginapan_id.required' => 'data penginapan tidak boleh kosong',
                'status.required' => 'status tidak boleh kosong',
                'hargaKamar.required' => 'harga tidak boleh kosong',
                'hargaKamar.numeric' => 'harga harus berupa angka',
                'image.required' => 'image tidak boleh kosong',
                'image.image' => 'image harus berupa gambar',
                'image.max' => 'image maksimal 2mb',
                'image.mimes' => 'image harus berupa jpeg,png,jpg,gif,svg',
            ],
        );
    }
    public function index()
    {
        $page = 'Kamar';
        $kamar = Kamar::with('rPenginapan')->get();
        $penginapan = Penginapan::all();
        return view('admin.pages.Kamar.index', compact('page', 'kamar', 'penginapan'));
    }

    public function store(Request $request)
    {
        $this->validateData($request);
        $penginapan = Penginapan::find($request->penginapan_id);
        $image = GlobalFunction::saveImage($request->file('image'), ($request->nomorKamar.'_'.$penginapan->nama_penginapan), $this->path);
        $data = [
            'nomor_kamar' => $request->nomorKamar,
            'id_penginapan' => $request->penginapan_id,
            'harga' => $request->hargaKamar,
            'status' => $request->status,
            'image' => $image,
        ];
        Kamar::create($data);

        return back()->with('success', 'Data Kamar Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $this->validateData($request, 'sometimes');

        $kamar = Kamar::find($id);
        $penginapan = Penginapan::find($request->penginapan_id);

        $data = [
            'nomor_kamar' => $request->nomorKamar,
            'id_penginapan' => $request->penginapan_id,
            'harga' => $request->hargaKamar,
            'status' => $request->status,
        ];

        if ($request->file('image')) {
            GlobalFunction::deleteImage($kamar->image, $this->path);
            $data['image'] = GlobalFunction::saveImage($request->file('image'), ($request->nomorKamar.'_'.$penginapan->nama_penginapan), $this->path);
        }

        Kamar::where('id', $id)->update($data);

        return back()->with('success', 'Data Kamar Berhasil Diubah');
    }

    public function destroy($id)
    {
        $kamar = Kamar::find($id);
        GlobalFunction::deleteImage($kamar->image, $this->path);
        $kamar->delete();
        return back()->with('success', 'Data Kamar Berhasil Dihapus');
    }
}
