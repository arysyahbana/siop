<?php

namespace App\Http\Controllers;

use App\Exports\GenericExport;
use App\Helpers\GlobalFunction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        $page = "Users";
        $users = User::get();
        return view('admin.pages.User.index', compact('page', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);

        $store = new User();
        $store->name = $request->nama;
        $store->email = $request->email;
        $store->role = $request->role;
        $store->no_hp = GlobalFunction::formatPhoneNumber($request->no_hp);
        $store->alamat = $request->alamat;
        $store->jenis_kelamin = $request->gender;
        $store->password = Hash::make($request->password);
        $store->save();

        return redirect()->route('users.show')->with('success', 'Data user berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        $update = User::find($id);
        $update->name = $request->nama;
        $update->email = $request->email;
        $update->role = $request->role;
        $update->no_hp = GlobalFunction::formatPhoneNumber($request->no_hp);
        $update->alamat = $request->alamat;
        $update->jenis_kelamin = $request->gender;
        if ($request->password != null) {
            $update->password = Hash::make($request->password);
        }
        $update->save();
        return redirect()->route('users.show')->with('success', 'Data user berhasil diubah.');
    }

    public function destroy($id)
    {
        $destroy = User::find($id);
        $destroy->delete();
        return redirect()->route('users.show')->with('success', 'Data user berhasil dihapus.');
    }

    public function download()
    {
        $columns = ['name', 'email', 'role', 'no_hp', 'alamat', 'jenis_kelamin'];

        return Excel::download(new GenericExport(User::class, $columns, 'G', 'penginapan'), 'User.xlsx');
    }
}
