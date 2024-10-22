<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenginapanController extends Controller
{
    public function index()
    {
        $page = "Penginapan";
        return view('admin.pages.Penginapan.index', compact('page'));
    }
}
