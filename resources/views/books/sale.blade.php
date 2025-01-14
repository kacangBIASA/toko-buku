@extends('layouts.app')


@section('title', 'Daftar Buku')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white">
            <h3 class="card-title">💸 Daftar Buku</h3>
        </div>
        <div class="card-body">
            {{-- Pesan Sukses dan Error --}}
            @if (session('error'))
                <div class="alert alert-danger">
                    <i class="bi bi-x-circle"></i> {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            {{-- Pencarian --}}
            <form action="{{ route('sales.index') }}" method="GET" class="d-flex mb-3">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari buku...">
                <button type="submit" class="btn btn-outline-light">
                    <i class="bi bi-search"></i> Cari
                </button>
            </form>

            {{-- Tabel Buku --}}
            <table class="table table-bordered table-hover bg-light" id="dataTable">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->category }}</td>
                            <td>Rp {{ number_format($book->price, 2, ',', '.') }}</td>
                            <td>
                                @if ($book->stock > 0)
                                    <span class="badge bg-success">{{ $book->stock }}</span>
                                @else
                                    <span class="badge bg-danger">Habis</span>
                                @endif
                            </td>
                            <td>
                                @if ($book->stock > 0)
                                    {{-- Tombol Tambah ke Keranjang --}}
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addToCartModal{{ $book->id }}">
                                        <i class="bi bi-cart-plus"></i> Tambah
                                    </button>
                                @else
                                    <button class="btn btn-secondary btn-sm" disabled>Stok Habis</button>
                                @endif
                                {{-- Tombol Detail --}}
                                <a href="{{ route('books.show', $book) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-info-circle"></i> Detail
                                </a>
                            </td>
                        </tr>

                        {{-- Modal Tambah ke Keranjang --}}
                        <div class="modal fade" id="addToCartModal{{ $book->id }}" tabindex="-1" aria-labelledby="addToCartLabel{{ $book->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addToCartLabel{{ $book->id }}">Tambah Buku ke Keranjang</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('cart.add', $book->id) }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="quantity{{ $book->id }}" class="form-label">Jumlah Buku</label>
                                                <input type="number" name="quantity" id="quantity{{ $book->id }}" class="form-control" min="1" max="{{ $book->stock }}" value="1" required>
                                                <small class="text-muted">Stok tersedia: {{ $book->stock }}</small>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary"><i class="bi bi-cart-check"></i> Tambahkan</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada buku ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $books->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
