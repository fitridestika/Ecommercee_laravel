<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\FlashSale;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index() {
        $products = Product::all();
        $flashSales = FlashSale::where('status', true)->get();

        return view('pages.user.index', compact('products','flashSales'));
    }
    public function detail_product($id)
{
    $product = Product::findOrFail($id);

    return view('pages.user.detail', compact('product'));
}
public function purchase($productId, $userId)
{
    $product = Product::findOrFail($productId);
    $user = User::findOrFail($userId);

    if ($user->point >= $product->price) {
        $totalPoints = $user->point - $product->price;

        $user->update([
            'point' => $totalPoints,
        ]);

        Alert::success('Berhasil!', 'Produk berhasil dibeli!');
        return redirect()->back();
    } else {
        Alert::error('Gagal!', 'Point anda tidak cukup!');
        return redirect()->back();
    }
}
}
