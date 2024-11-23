<?php

namespace App\Http\Controllers;

use App\Exports\GenericExport;
use App\Models\Transportasi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TransportasiController extends Controller
{
    private function validateData(Request $request)
    {
        return $request->validate(
            [
                'namaTransportasi' => 'required',
                'harga' => 'required|numeric',
                'deskripsi' => 'required',
                'rute' => 'required',
            ],
            [
                'namaTransportasi.required' => 'nama transportasi tidak boleh kosong',
                'harga.required' => 'harga tidak boleh kosong',
                'harga.numeric' => 'harga harus berupa angka',
                'deskripsi.required' => 'deskripsi tidak boleh kosong',
                'rute.required' => 'rute tidak boleh kosong',
            ],
        );
    }

    public function index()
    {
        $page = 'Transportasi';
        $transportasi = Transportasi::all();
        return view('admin.pages.Transportasi.index', compact('page', 'transportasi'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        Transportasi::create($data);

        return redirect()->back()->with('success', 'Berhasil menambahkan transportasi');
    }

    public function update(Request $request, $id)
    {
        $data = $this->validateData($request);
        $transportasi = Transportasi::findOrFail($id);
        $transportasi->update($data);

        return redirect()->back()->with('success', 'Berhasil mengupdate transportasi');
    }

    public function destroy($id)
    {
        $transportasi = Transportasi::findOrFail($id);
        $transportasi->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus transportasi');
    }

    public function download()
    {
        $columns = ['namaTransportasi', 'harga', 'deskripsi', 'rute'];

        return Excel::download(new GenericExport(Transportasi::class, $columns, 'E'), 'Transportasi.xlsx');
    }
}
