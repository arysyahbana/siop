<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ObjekWisataController extends Controller
{
    public function index()
    {
        $page = "Objek Pariwisata";
        return view('admin.pages.ObjekWisata.index', compact('page'));
    }
}
