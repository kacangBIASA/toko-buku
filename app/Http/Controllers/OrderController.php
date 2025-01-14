<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Book;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems.book')->get(); // Mengambil semua data dari tabel orders
        return view('order.index', compact('orders'));
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:15',
        ]);

        // Ambil data keranjang
        $cartItems = Cart::with('book')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        // Hitung total harga
        $totalPrice = $cartItems->sum(fn($item) => $item->book->price * $item->quantity);

        // Buat pesanan baru
        $order = Order::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'total_price' => $totalPrice,
        ]);

        // Simpan item pesanan
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $item->book->id,
                'quantity' => $item->quantity,
                'price' => $item->book->price,
            ]);
        }

        // Kosongkan keranjang
        Cart::truncate();

        // Cetak struk pembelian
        $pdf = Pdf::loadView('receipt', [
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'items' => $cartItems->map(fn($item) => [
                'name' => $item->book->title,
                'quantity' => $item->quantity,
                'price' => $item->book->price
            ])->toArray(),
        ]);

        return $pdf->download('receipt.pdf');

        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'address' => 'required|string|max:500',
        //     'phone' => 'required|string|max:15',
        // ]);

        // // Ambil data keranjang
        // $cartItems = Cart::with('book')->get();

        // if ($cartItems->isEmpty()) {
        //     return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        // }

        // // Hitung total harga
        // $totalPrice = $cartItems->sum(function ($item) {
        //     return $item->book->price * $item->quantity;
        // });

        // DB::beginTransaction();

        // try {
        //     // Buat pesanan
        //     $order = Order::create([
        //         'name' => $request->name,
        //         'address' => $request->address,
        //         'phone' => $request->phone,
        //         'total_price' => $totalPrice,
        //     ]);

        //     // Tambahkan item ke order_items
        //     foreach ($cartItems as $item) {
        //         OrderItem::create([
        //             'order_id' => $order->id,
        //             'book_id' => $item->book_id,
        //             'quantity' => $item->quantity,
        //             'price' => $item->book->price,
        //         ]);
        //     }

        //     // Kosongkan keranjang
        //     Cart::truncate();

        //     DB::commit();
        // } catch (\Exception $e) {
        //     DB::rollBack();

        //     return redirect()->route('cart.index')->with('error', 'Terjadi kesalahan saat checkout!');
        // }

        // // Data untuk struk
        // $data = [
        //     'name' => $request->name,
        //     'address' => $request->address,
        //     'phone' => $request->phone,
        //     'total_price' => $totalPrice,
        //     'items' => $cartItems,
        // ];

        // // Generate PDF
        // $pdf = Pdf::loadView('receipt', $data);
        // return $pdf->download('receipt.pdf');
    }
}
