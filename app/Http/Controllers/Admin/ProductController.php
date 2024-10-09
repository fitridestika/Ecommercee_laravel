<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        confirmDelete('Hapus Data!', 'Apakah anda yakin menghapus data ini?');

        return view('pages.admin.product.index', compact('products'));
    }
    
    public function create()
    {
        return view('pages.admin.product.create');
    }

    public function store(Request $request) {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png',
        ]);
    
        if ($validation->fails()) {
            Alert::error('Gagal', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validation)->withInput();
        }
    
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
        }
    
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            'description' => $request->description,
            'image' => $imageName,
        ]);
    
        if ($product) {
            Alert::success('Berhasil', 'Produk berhasil ditambahkan!');
            return redirect()->route('admin.product');
        }
    
        return redirect()->back()->with('error', 'Produk gagal ditambahkan!');
        
    }
    public function detail($id)
    {
        $product = Product::findOrFail($id);

        return view('pages.admin.product.detail', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('pages.admin.product.edit', compact('product'));
    }
    public function update(Request $request, $id)
{
    // Validasi input yang dikirim melalui form
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'price' => 'numeric',
        'category' => 'required',
        'description' => 'required',
        'image' => 'nullable|mimes:png,jpeg,jpg',
    ]);

    // Jika validasi gagal
    if ($validator->fails()) {
        Alert::error('Gagal', 'Pastikan semua terisi dengan benar!');
        return redirect()->back();
    }

    // Temukan produk berdasarkan ID
    $product = Product::findOrFail($id);

    // Jika ada file gambar baru yang di-upload
    if ($request->hasFile('image')) {
        $oldPath = public_path('images/' . $product->image);
        
        // Hapus gambar lama jika ada
        if (File::exists($oldPath)) {
            File::delete($oldPath);
        }

        // Simpan gambar baru
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move('images', $imageName);
    } else {
        // Jika tidak ada gambar baru, tetap gunakan gambar lama
        $imageName = $product->image;
    }

    // Update produk dengan data baru
    $product->update([
        'name' => $request->name,
        'price' => $request->price,
        'category' => $request->category,
        'description' => $request->description,
        'image' => $imageName,
    ]);

    // Cek apakah update berhasil
    if ($product) {
        Alert::success('Berhasil', 'Produk berhasil diperbarui!');
        return redirect()->route('admin.product');
    } else {
        Alert::error('Gagal', 'Produk gagal diperbarui!');
        return redirect()->back();
        }
    }
    public function delete($id)
{
    $product = Product::findOrFail($id);

    $oldPath = public_path('images/' . $product->image);
    if (File::exists($oldPath)) {
        File::delete($oldPath);
    }

    $product = $product->delete();

    if ($product) {
        Alert::success('Berhasil!', 'Produk berhasil dihapus!');
        return redirect()->back();
    } else {
        Alert::error('Gagal!', 'Produk gagal dihapus!');
        return redirect()->back();
    }
}

}
