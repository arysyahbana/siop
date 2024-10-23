<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
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
        $page = 'Owner';
        $pemilik = User::where('role', 'Pemilik')->get();
        return view('admin.pages.Owner.index', compact('page', 'pemilik'));
    }

    public function store(Request $request)
    {
    }
}
