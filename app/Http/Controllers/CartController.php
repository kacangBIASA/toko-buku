<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // $carts = Cart::with('book')->get();
        // return view('cart.index', compact('carts'));

        $cartItems = Cart::with('book')->get();
        return view('cart.index', compact('cartItems'));
    }

    public function addToCart(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        // Ambil jumlah dari form
        $quantity = $request->input('quantity', 1);

        // Periksa apakah stok tersedia
        if ($book->stock < $quantity) {
            return redirect()->route('sales.index')->with('error', 'Jumlah yang diminta melebihi stok tersedia!');
        }

        // Periksa apakah buku sudah ada di keranjang
        $cartItem = Cart::where('book_id', $book->id)->first();

        if ($cartItem) {
            // Validasi jika stok tidak cukup untuk menambahkan quantity yang baru
            $totalQuantity = $cartItem->quantity + $quantity;
            if ($book->stock < $totalQuantity) {
                return redirect()->route('sales.index')->with('error', 'Jumlah yang diminta melebihi stok tersedia!');
            }

            // Tambahkan quantity di keranjang
            $cartItem->quantity = $totalQuantity;
            $cartItem->save();
        } else {
            // Tambahkan buku baru ke keranjang
            Cart::create([
                'book_id' => $book->id,
                'quantity' => $quantity,
            ]);
        }

        // Kurangi stok buku
        $book->stock -= $quantity;
        $book->save();

        return redirect()->route('sales.index')->with('success', 'Buku berhasil ditambahkan ke keranjang.');
    }


    public function updateQuantity(Request $request, $id)
    {
        $cartItem = Cart::findOrFail($id);
        $book = $cartItem->book;

        $newQuantity = $request->input('quantity');

        // Periksa apakah stok mencukupi
        if ($newQuantity > $book->stock + $cartItem->quantity) {
            return redirect()->route('cart.index')->with('error', 'Stok tidak mencukupi untuk jumlah yang diminta.');
        }

        // Kembalikan stok lama ke buku, lalu kurangi stok baru
        $book->stock += $cartItem->quantity;
        $book->stock -= $newQuantity;
        $book->save();

        // Update quantity di keranjang
        $cartItem->quantity = $newQuantity;
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Quantity berhasil diperbarui.');
    }

    public function delete($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Buku berhasil dihapus dari keranjang.');
    }
}
