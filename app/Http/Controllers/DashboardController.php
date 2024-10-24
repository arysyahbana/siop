<?php

namespace App\Http\Controllers;

use App\Models\ObjekWisata;
use App\Models\PaketTour;
use App\Models\Penginapan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $page = 'Dashboard';

        $objekWisata = ObjekWisata::count();
        $penginapan = Penginapan::all();
        if (Auth::check() && Auth::user()->role == 'Pemilik') {
            $penginapan = $penginapan->where('id_pemilik', Auth::user()->id);
        }
        $penginapan = $penginapan->count();
        $paketTour = PaketTour::all();
        if (Auth::check() && Auth::user()->role == 'Pemilik') {
            $paketTour = $paketTour->where('id_pemilik', Auth::user()->id);
        }
        $paketTour = $paketTour->count();
        $user = User::where('role', 'Pemilik')->count();

        return view('admin.pages.dashboard', compact('page', 'objekWisata', 'penginapan', 'paketTour', 'user'));
    }
}
