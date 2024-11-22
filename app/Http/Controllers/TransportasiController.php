<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransportasiController extends Controller
{
    public function index()
    {
        $page = 'Transportasi';
        return view('admin.pages.Transportasi.index', compact('page'));
    }
}
