<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $page = "Kategori";
        return view('admin.pages.Kategori.index', compact('page'));
    }
}
