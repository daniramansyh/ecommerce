<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::with('product', 'user')->simplePaginate(10);
        return view('pages.kelola_cart', compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric',
        ]);

        // Ambil data produk
        $product = Product::findOrFail($request->product_id);

        // Cek stok produk
        if ($request->quantity > $product->stock) {
            return back()->with('error', 'Jumlah melebihi stok tersedia.');
        }

        // Tambahkan item ke keranjang
        $cart = Cart::create([
            'user_id' => Auth::id(), // ID user yang sedang login
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'total_price' => $request->price * $request->quantity,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();

        // Hitung total harga semua item dalam keranjang
        $totalPrice = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        return view('pages.cart', compact('carts', 'totalPrice'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        if (Auth::user()->role == "Admin") {
            return redirect()->route('cart.data')->with('success', 'Item berhasil dihapus');
        } else {
            return redirect()->back()->with('success', 'Item berhasil dihapus');
        }
    }
}
