<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::where('title', 'like', "%{$request->input('search')}%")
            ->orWhere('author', 'like', "%{$request->input('search')}%")
            ->paginate(10);

        return view('books.sale', compact('books'));
    }

    // public function create()
    // {
    //     return view('books.create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'author' => 'required|string|max:255',
    //         'category' => 'required|string|max:255',
    //         'price' => 'required|numeric|min:0',
    //         'stock' => 'required|integer|min:0',
    //     ]);

    //     Book::create($request->all());
    //     return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::find($id);
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     $book = Book::findOrFail($id);
    //     return view('books.edit', compact('book'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Book $book)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'author' => 'required|string|max:255',
    //         'category' => 'required|string|max:255',
    //         'price' => 'required|numeric|min:0',
    //         'stock' => 'required|integer|min:0',
    //     ]);

    //     $book->update($request->all());
    //     return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui.');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Book $book)
    // {
    //     $book->delete();
    //     return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    // }
}
