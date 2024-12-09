<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orderBy = $request->sort_stock ? 'stock' : 'name';
        $products = Product::where('name', 'LIKE', '%'.$request->cari.'%')->orderBy($orderBy, 'ASC')->simplePaginate(5)->appends($request->all());
        return view('pages.kelola_produk', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'type' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Simpan gambar dan ambil path
            $path = $request->file('image')->store('images', 'public');
        } else {
            $path = null; // Tidak ada gambar
        }
    
        Product::create([
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $path
        ]);
        return redirect()->back()->with('success', 'Berhasil Menambah Data Product!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $Product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $products = Product::find($id);
        return view('product.edit', compact('products'));
    }

    /** 
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'type' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product = Product::find($id);

        // Cek apakah gambar diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image && Storage::exists('public/' . $product->image)) {
                Storage::delete('public/' . $product->image);
            }
    
            // Simpan gambar baru dan ambil path-nya
            $path = $request->file('image')->store('images', 'public');
        } else {
            $path = $product->image; // Gunakan gambar lama jika tidak ada gambar baru
        }

        Product::where('id', $id)->update([
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'image' => $path
        ]);

        return redirect()->route('produk.data')->with('success', 'Berhasil Mengubah produk!');
    }

    public function updateStock(Request $request,$id){
        if(isset($request->stock) == false) {
            $ProductBefore = Product::find($id);
            return redirect()->back()->with([
                'failed' => 'stock tidak boleh kosong!',
                'id' => $id,
                'stock' => $ProductBefore
                ['stock']
            ]);
        }

        Product::where('id',$id)->update([
            'stock' => $request->stock]);
            return redirect()->back()->with('success', 'Berhasil Mengubah Stock Produk!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Product::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Product!');
    }

    public function detail($id){
        $product = Product::findOrFail($id);
        return view('product.detail', compact('product'));
    }
};