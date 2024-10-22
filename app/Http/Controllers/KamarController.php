<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index()
    {
        $page = "Kamar";
        return view('admin.pages.Kamar.index', compact('page'));
    }
}
