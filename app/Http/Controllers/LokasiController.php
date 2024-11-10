<?php

namespace App\Http\Controllers;

use App\Exports\GenericExport;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LokasiController extends Controller
{
    public function index()
    {
        $page = 'Lokasi';
        $lokasi = Lokasi::all();
        return view('admin.pages.Lokasi.index', compact('page', 'lokasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lokasi' => 'required',
        ]);

        Lokasi::create([
            'nama_lokasi' => $request->lokasi,
        ]);

        return back()->with('success', 'Data lokasi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'lokasi' => 'required',
        ]);

        Lokasi::find($id)->update([
            'nama_lokasi' => $request->lokasi,
        ]);

        return back()->with('success', 'Data lokasi berhasil diubah.');
    }

    public function destroy($id)
    {
        Lokasi::find($id)->delete();
        return back()->with('success', 'Data lokasi berhasil dihapus.');
    }

    public function download()
    {
        $columns = ['nama_lokasi'];

        return Excel::download(new GenericExport(Lokasi::class, $columns, 'B'), 'Lokasi.xlsx');
    }
}
