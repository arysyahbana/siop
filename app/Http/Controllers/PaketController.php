<?php

namespace App\Http\Controllers;

use App\Exports\GenericExport;
use App\Helpers\GlobalFunction;
use App\Models\ItemTambahan;
use App\Models\ObjekWisata;
use App\Models\PaketTour;
use App\Models\Penginapan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PaketController extends Controller
{
    protected $path;
    public function __construct()
    {
        $this->path = 'paket-tour/';
    }
    private function validateData(Request $request, $imageRule = 'required')
    {
        return $request->validate(
            [
                'namaPaket' => 'required',
                'deskripsi' => 'required',
                'wisata_id' => 'required',
                'penginapan_id' => 'required',
                'owner_id' => 'required',
                'hargaPaket' => 'required|numeric',
                'image' => $imageRule . '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'namaPaket.required' => 'Nama Paket tidak boleh kosong',
                'deskripsi.required' => 'Deskripsi tidak boleh kosong',
                'wisata_id.required' => 'data objek wisata tidak boleh kosong',
                'penginapan_id.required' => 'data penginapan tidak boleh kosong',
                'owner_id.required' => 'data pemilik tidak boleh kosong',
                'hargaPaket.required' => 'harga tidak boleh kosong',
                'hargaPaket.numeric' => 'harga harus berupa angka',
                'image.required' => 'image tidak boleh kosong',
                'image.image' => 'image harus berupa gambar',
                'image.max' => 'image maksimal 2mb',
                'image.mimes' => 'image harus berupa jpeg,png,jpg,gif,svg',
            ],
        );
    }
    public function index()
    {
        $page = 'Paket';
        $objekWisata = ObjekWisata::all();
        $penginapan = Penginapan::all();
        if (Auth::user()->role == 'Pemilik') {
            $penginapan = $penginapan->where('id_pemilik', Auth::user()->id);
        }
        $pemilik = User::where('role', 'Pemilik')->get();
        $paketTour = PaketTour::with('rObjekWisata', 'rPenginapan', 'rPemilik', 'rItemTambahan')->get();
        return view('admin.pages.Paket.index', compact('page', 'objekWisata', 'penginapan', 'pemilik', 'paketTour'));
    }

    public function store(Request $request)
    {
        $this->validateData($request);
        $image = GlobalFunction::saveImage($request->file('image'), $request->namaPaket, $this->path);
        $data = [
            'nama_paket' => $request->namaPaket,
            'deskripsi' => $request->deskripsi,
            'id_objek_wisata' => $request->wisata_id,
            'id_penginapan' => $request->penginapan_id,
            'id_pemilik' => $request->owner_id,
            'harga' => $request->hargaPaket,
            'image' => $image,
        ];
        $paketTour = PaketTour::create($data);
        $itemTambahan = $request->item;
        if ($itemTambahan) {
            foreach ($itemTambahan as $item) {
                ItemTambahan::create([
                    'id_paket_tour' => $paketTour->id,
                    'nama_item' => $item,
                ]);
            }
        }

        return back()->with('success', 'Data Paket Tour Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $page = 'Paket';
        $objekWisata = ObjekWisata::all();
        $penginapan = Penginapan::all();
        if (Auth::user()->role == 'Pemilik') {
            $penginapan = $penginapan->where('id_pemilik', Auth::user()->id);
        }
        $pemilik = User::where('role', 'Pemilik')->get();
        $paketTour = PaketTour::with('rObjekWisata', 'rPenginapan', 'rPemilik', 'rItemTambahan')->find($id);
        return view('admin.pages.Paket.edit', compact('page', 'paketTour', 'objekWisata', 'penginapan', 'pemilik'));
    }

    public function update(Request $request, $id)
    {
        $this->validateData($request, 'sometimes');
        $data = [
            'nama_paket' => $request->namaPaket,
            'deskripsi' => $request->deskripsi,
            'id_objek_wisata' => $request->wisata_id,
            'id_penginapan' => $request->penginapan_id,
            'id_pemilik' => $request->owner_id,
            'harga' => $request->hargaPaket,
        ];
        $paketTour = PaketTour::find($id);

        if ($request->file('image')) {
            GlobalFunction::deleteImage($paketTour->image, $this->path);
            $data['image'] = GlobalFunction::saveImage($request->file('image'), $request->namaPaket, $this->path);
        }
        $paketTour->update($data);
        $itemTambahan = $request->item;
        if ($itemTambahan) {
            ItemTambahan::where('id_paket_tour', $id)->delete();
            foreach ($itemTambahan as $item) {
                ItemTambahan::create([
                    'id_paket_tour' => $paketTour->id,
                    'nama_item' => $item,
                ]);
            }
        }
        return redirect()->route('paket.show')->with('success', 'Data Paket Tour Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $paketTour = PaketTour::find($id);
        GlobalFunction::deleteImage($paketTour->image, $this->path);
        $paketTour->rItemTambahan()->delete();
        $paketTour->delete();
        return back()->with('success', 'Data Paket Tour Berhasil Dihapus');
    }

    public function download()
    {
        $columns = ['nama_paket', 'harga', 'image'];

        $relations = [
            'rObjekWisata' => ['nama_wisata'],
            'rPenginapan' => ['nama_penginapan'],
            'rItemTambahan' => ['nama_item'],
        ];

        return Excel::download(new GenericExport(PaketTour::class, $columns, 'G', 'paket-tour', $relations), 'Paket Tour.xlsx');
    }
}
