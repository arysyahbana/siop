<?php

namespace App\Http\Controllers;

use App\Exports\GenericExport;
use App\Helpers\GlobalFunction;
use App\Models\Kamar;
use App\Models\Penginapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
                'kapasitasKamar' => 'required',
                'penginapan_id' => 'required',
                'deskripsi' => 'required',
                'status' => 'required',
                'hargaKamar' => 'required|numeric',
                'image' => $imageRule . '|array',
                'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi untuk setiap item di dalam array image
            ],
            [
                'nomorKamar.required' => 'Nomor Kamar tidak boleh kosong',
                'kapasitasKamar.required' => 'Kapasitas Kamar tidak boleh kosong',
                'penginapan_id.required' => 'Data penginapan tidak boleh kosong',
                'status.required' => 'Status tidak boleh kosong',
                'deskripsi.required' => 'Deskripsi tidak boleh kosong',
                'hargaKamar.required' => 'Harga tidak boleh kosong',
                'hargaKamar.numeric' => 'Harga harus berupa angka',
                'image.required' => 'Gambar tidak boleh kosong',
                'image.array' => 'Gambar harus dalam format array',
                'image.*.image' => 'Setiap file harus berupa gambar',
                'image.*.max' => 'Setiap gambar maksimal 2MB',
                'image.*.mimes' => 'Setiap gambar harus berupa jpeg, png, jpg, gif, atau svg',
            ],
        );
    }
    public function index()
    {
        $page = 'Kamar';
        $user = Auth::user();
        $penginapan = Penginapan::all();
        $kamar = Kamar::with('rPenginapan')->get();

        if ($user && $user->role == 'Pemilik') {
            $penginapan = Penginapan::where('id_pemilik', $user->id)->get();

            if ($penginapan->isNotEmpty()) {
                $penginapanIds = $penginapan->pluck('id');
                $kamar = Kamar::with('rPenginapan')->whereIn('id_penginapan', $penginapanIds)->get();
            } else {
                $kamar = collect();
            }
        }

        return view('admin.pages.Kamar.index', compact('page', 'kamar', 'penginapan'));
    }

    public function store(Request $request)
    {
        $this->validateData($request);
        $penginapan = Penginapan::find($request->penginapan_id);
        $images = $request->file('image');
        if (!is_array($images)) {
            $images = explode(',', $images);
        }

        $savedImages = [];
        foreach ($images as $index => $image) {
            $savedImages[] = GlobalFunction::saveImage($image, $request->nomorKamar . '_' . $penginapan->nama_penginapan . '_Gambar' . ($index + 1), $this->path);
        }

        $image = implode(',', $savedImages);
        $data = [
            'nomor_kamar' => $request->nomorKamar,
            'kapasitas_kamar' => $request->kapasitasKamar,
            'id_penginapan' => $request->penginapan_id,
            'deskripsi' => $request->deskripsi,
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
            'kapasitas_kamar' => $request->kapasitasKamar,
            'id_penginapan' => $request->penginapan_id,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->hargaKamar,
            'status' => $request->status,
        ];
        $images = $request->file('image');
        if ($images) {
            if (!is_array($images)) {
                $images = explode(',', $images);
            }
            foreach (explode(',', $kamar->image) as $listImage) {
                GlobalFunction::deleteImage(trim($listImage), $this->path);
            }
            $savedImages = [];
            foreach ($images as $index => $image) {
                $savedImages[] = GlobalFunction::saveImage($image, $request->nomorKamar . '_' . $penginapan->nama_penginapan . '_Gambar' . ($index + 1), $this->path);
            }
            $data['image'] = implode(',', $savedImages);
        }

        Kamar::where('id', $id)->update($data);

        return back()->with('success', 'Data Kamar Berhasil Diubah');
    }

    public function destroy($id)
    {
        $kamar = Kamar::find($id);
        foreach (explode(',', $kamar->image) as $listImage  ) {
            GlobalFunction::deleteImage(trim($listImage), $this->path);
        }
        $kamar->delete();
        return back()->with('success', 'Data Kamar Berhasil Dihapus');
    }

    public function download()
    {
        $columns = ['nomor_kamar', 'harga', 'status', 'image','kapasitas_kamar'];

        $relations = [
            'rPenginapan' => ['nama_penginapan'],
        ];

        return Excel::download(new GenericExport(Kamar::class, $columns, 'G', 'kamar', $relations), 'kamar.xlsx');
    }
}
