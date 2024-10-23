<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Distributor;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

class DistributorController extends Controller
{
    public function index()
    {
        $distributors = Distributor::all();
        confirmDelete('Hapus Data!', 'Apakah anda yakin ingin menghapus data ini?');

        return view('pages.admin.distributor.index', compact('distributors'));
    }

    public function create()
    {
        return view('pages.admin.distributor.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_distributor' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'kontak' => 'required',
            'email' => 'required|email|unique:distributors,email',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back();
        }

        $distributor = Distributor::create([
            'name_distributor' => $request->name_distributor,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'kontak' => $request->kontak,
            'email' => $request->email,
        ]);

        if ($distributor) {
            Alert::success('Berhasil!', 'Distributor berhasil ditambahkan!');
            return redirect()->route('admin.distributor');
        } else {
            Alert::error('Gagal!', 'Distributor gagal ditambahkan!');
            return redirect()->back();
        }
    }

    public function detail($id)
    {
        $distributor = Distributor::findOrFail($id);
        return view('pages.admin.distributor.detail', compact('distributor'));
    }

    public function edit($id)
    {
        $distributor = Distributor::findOrFail($id);
        return view('pages.admin.distributor.edit', compact('distributor'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name_distributor' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'kontak' => 'required',
            'email' => 'required|email|unique:distributors,email,' . $id,
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back();
        }

        $distributor = Distributor::findOrFail($id);
        $distributor->update([
            'name_distributor' => $request->name_distributor,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'kontak' => $request->kontak,
            'email' => $request->email,
        ]);

        if ($distributor) {
            Alert::success('Berhasil!', 'Distributor berhasil diperbarui!');
            return redirect()->route('admin.distributor');
        } else {
            Alert::error('Gagal!', 'Distributor gagal diperbarui!');
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $distributor = Distributor::findOrFail($id);
        $distributor->delete();

        if ($distributor) {
            Alert::success('Berhasil!', 'Distributor berhasil dihapus!');
            return redirect()->back();
        } else {
            Alert::error('Gagal!', 'Distributor gagal dihapus!');
            return redirect()->back();
        }
    }
}