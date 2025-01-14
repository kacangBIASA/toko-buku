@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="card shadow-lg">
    <div class="card-header bg-dark text-white">
        <h3 class="card-title">Keranjang Belanja</h3>
    </div>
    <div class="card-body">
        @if($cartItems->isEmpty())
            <div class="alert alert-warning text-center">
                <p>Keranjang Anda kosong. <a href="{{ route('sales.index') }}" class="alert-link">Belanja sekarang</a>.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Judul Buku</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                        <tr>
                            <td>{{ $item->book->title }}</td>
                            <td>Rp{{ number_format($item->book->price, 0, ',', '.') }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp{{ number_format($item->book->price * $item->quantity, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.delete', $item->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4><strong>Total Harga:</strong> Rp{{ number_format($cartItems->sum(fn($item) => $item->book->price * $item->quantity), 0, ',', '.') }}</h4>
                <a href="{{ route('sales.index') }}" class="btn btn-outline-primary">Tambah Buku</a>
            </div>

            {{-- Form Input Informasi Pembeli --}}
            <form action="{{ route('checkout') }}" method="POST" class="bg-light p-4 rounded shadow-sm">
                @csrf
                <h5 class="mb-4">Informasi Pembeli</h5>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama:</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Nama lengkap" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat:</label>
                    <textarea id="address" name="address" class="form-control" placeholder="Alamat lengkap" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">No. Telepon:</label>
                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Nomor telepon" required>
                </div>
                <button type="submit" class="btn btn-success btn-block">Beli</button>
                <a href="{{ route('sales.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        @endif
    </div>
</div>
@endsection
