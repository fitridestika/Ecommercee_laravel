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
        $admins = Admin ::all(); // Fetch all data from Admin table
        $users = User::all();   // Fetch all data from User table
        $skripsis = Skripsi::all();   // Fetch all data from User table


        return view('welcome', compact('admins', 'users', 'skripsis'));
    }
}
