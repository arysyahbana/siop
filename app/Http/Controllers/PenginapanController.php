<?php

namespace App\Http\Controllers;

use App\Exports\GenericExport;
use App\Helpers\GlobalFunction;
use App\Models\Penginapan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PenginapanController extends Controller
{
    protected $path;
    public function __construct()
    {
        $this->path = 'penginapan/';
    }
    private function validateData(Request $request, $imageRule = 'required')
    {
        return $request->validate(
            [
                'namaPenginapan' => 'required',
                'deskripsi' => 'required',
                'lokasi' => 'required',
                'owner_id' => 'required',
                'image' => $imageRule . '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'namaPenginapan.required' => 'nama penginapan tidak boleh kosong',
                'deskripsi.required' => 'deskripsi tidak boleh kosong',
                'lokasi.required' => 'lokasi tidak boleh kosong',
                'owner_id.required' => 'data pemilik tidak boleh kosong',
                'image.required' => 'image tidak boleh kosong',
                'image.image' => 'image harus berupa gambar',
                'image.max' => 'image maksimal 2mb',
                'image.mimes' => 'image harus berupa jpeg,png,jpg,gif,svg',
            ],
        );
    }
    public function index()
    {
        $page = 'Penginapan';
        $penginapan = Penginapan::with('rPemilik')->get();
        if(Auth::user()->role == 'Pemilik'){
            $penginapan = $penginapan->where('id_pemilik', Auth::user()->id);
        }
        $pemilik = User::where('role', 'Pemilik')->get();
        return view('admin.pages.Penginapan.index', compact('page', 'penginapan', 'pemilik'));
    }

    public function store(Request $request)
    {
        $this->validateData($request);
        $image = GlobalFunction::saveImage($request->file('image'), $request->namaPenginapan, $this->path);
        $data = [
            'nama_penginapan' => $request->namaPenginapan,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'id_pemilik' => $request->owner_id,
            'image' => $image,
        ];
        Penginapan::create($data);

        return back()->with('success', 'Data Penginapan Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $this->validateData($request, 'sometimes');

        $penginapan = Penginapan::find($id);

        $data = [
            'nama_penginapan' => $request->namaPenginapan,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'id_pemilik' => $request->owner_id,
        ];

        if ($request->file('image')) {
            GlobalFunction::deleteImage($penginapan->image, $this->path);
            $data['image'] = GlobalFunction::saveImage($request->file('image'), $request->namaPenginapan, $this->path);
        }

        Penginapan::where('id', $id)->update($data);

        return back()->with('success', 'Data Penginapan Berhasil Diubah');
    }

    public function destroy($id)
    {
        $penginapan = Penginapan::find($id);
        GlobalFunction::deleteImage($penginapan->image, $this->path);
        $penginapan->delete();
        return back()->with('success', 'Data Penginapan Berhasil Dihapus');
    }

    public function download()
    {
        $columns = ['nama_penginapan', 'deskripsi', 'lokasi', 'image'];

        $relations = [
            'rPemilik' => ['name', 'no_hp'],
        ];

        return Excel::download(new GenericExport(Penginapan::class, $columns, 'G', 'penginapan', $relations), 'Penginapan.xlsx');
    }
}
