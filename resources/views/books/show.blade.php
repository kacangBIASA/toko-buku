@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-dark text-white">
            <h3 class="card-title text-uppercase text-center">
                📖 {{ $book->title }}
            </h3>
        </div>
        <div class="card-body">

            {{-- Informasi Buku --}}
            <table class="table table-borderless">
                <tr>
                    <th>📚 Penulis</th>
                    <td>{{ $book->author }}</td>
                </tr>
                <tr>
                    <th>🏷️ Kategori</th>
                    <td>{{ $book->category }}</td>
                </tr>
                <tr>
                    <th>💰 Harga</th>
                    <td>Rp {{ number_format($book->price, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>📦 Stok</th>
                    <td>
                        @if ($book->stock > 0)
                            <span class="badge bg-success">{{ $book->stock }} Tersedia</span>
                        @else
                            <span class="badge bg-danger">Habis</span>
                        @endif
                    </td>
                </tr>
            </table>

            {{-- Aksi --}}
            <div class="d-flex justify-content-center mt-4">
                @if ($book->stock > 0)
                    <form action="{{ route('cart.add', $book->id) }}" method="POST" class="me-2">
                        @csrf
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                        </button>
                    </form>
                @else
                    <button class="btn btn-secondary btn-lg" disabled>
                        <i class="bi bi-x-circle"></i> Stok Habis
                    </button>
                @endif
                <a href="{{ route('sales.index') }}" class="btn btn-outline-secondary btn-lg">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-footer text-muted text-center">
            📅 Terakhir diperbarui: {{ $book->updated_at->format('d M Y') }}
        </div>
    </div>
</div>
@endsection
