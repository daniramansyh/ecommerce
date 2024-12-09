<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $orders = Order::with('user', 'product')
            ->when($search, function ($query, $search) {
                return $query->where('order_number', 'LIKE', "%{$search}%")
                    ->orWhereHas('user', function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%{$search}%");
                    });
            })->paginate(10);
        return view('pages.kelola_order', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Order $order, $id)
    {
        $product = Product::findOrFail($id);
        return view('pages.checkout', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'address' => 'required|string|max:255',
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'payment_method' => 'required|string', // Bebas
        'shipping_method' => 'required|string', // Bebas
    ]);

    $product = Product::findOrFail($request->product_id);

    if ($request->quantity > $product->stock) {
        return redirect()->back()->with('error', 'Jumlah pesanan melebihi stok yang tersedia.');
    }

    $totalPrice = $request->quantity * $product->price;

    $orderNumber = 'ORD-' . time() . '-' . Str::random(5);

    $order = Order::create([
        'order_number' => $orderNumber,
        'user_id' => Auth::id(),
        'product_id' => $request->product_id,
        'quantity' => $request->quantity,
        'address' => $request->address,
        'price' => $product->price,
        'payment_method' => $request->payment_method,
        'shipping_method' => $request->shipping_method,
        'total_price' => $totalPrice,
        'status' => 'Pending'
    ]);

    $product->decrement('stock', $request->quantity);

    if ($order) {
        return redirect()->route('order.success', $order->id);
    } else {
        return redirect()->back()->with('failed', 'Gagal membuat data pembelian. Silahkan coba kembali dengan data yang sesuai!');
    }
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::find($id);
        return view('pages.success', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        // Hapus pesanan
        $order->delete();

        return redirect()->route('order.data')->with('success', 'Pesanan berhasil dihapus.');
    }
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Update status order
        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->route('order.data')->with('success', 'Status pesanan berhasil diperbarui.');
    }
    public function downloadPDF($id) { 
        $order = Order::with('user', 'product')->find($id)->toArray(); 
        view()->share('order',$order); 
        $pdf = Pdf::loadView('pages.nota', $order); 
        return $pdf->download('nota.pdf'); 
    }

    public function exportExcel() {
        return Excel::download(new OrdersExport, 'data_order.xlsx');
    }

}
