<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        $page = "Paket";
        return view('admin.pages.Paket.index', compact('page'));
    }

    public function edit()
    {
        $page = "Paket";
        return view('admin.pages.Paket.edit', compact('page'));
    }
}
