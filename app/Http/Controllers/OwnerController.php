<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        $page = "Owner";
        return view('admin.pages.Owner.index', compact('page'));
    }
}
