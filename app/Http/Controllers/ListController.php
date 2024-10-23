<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Skripsi;

class ListController extends Controller
{
    public function index()
    {
        $admins = Admin::all(); // Mengambil semua data dari tabel Admin
        $users = User::all();   // Mengambil semua data dari tabel User
        $skripsis = Skripsi::all(); // Mengambil semua data dari tabel Skripsi

        return view('welcome', compact('admins', 'users', 'skripsis'));
    }
}
