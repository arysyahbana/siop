<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $page = 'Lokasi';
        return view('admin.pages.Lokasi.index', compact('page'));
    }
}
