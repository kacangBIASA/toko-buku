@extends('layouts.app')
@extends('layouts.footer')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center mb-4 text-primary font-weight-bold">Customer Dashboard</h2>
        </div>

        <div class="d-flex justify-content-center">
            <!-- Card for Book Listings -->
            <div class="col-md-6 col-lg-4 mb-4 mx-2">
                <div class="card shadow-lg h-100">
                    <div class="card-header bg-info text-white">
                        <h4 class="card-title">Lihat Buku</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Jelajahi berbagai koleksi buku yang tersedia di toko kami. Temukan buku-buku terbaik untuk Anda.</p>
                        <a href="{{ route('sales.index') }}" class="btn btn-light btn-block">Lihat Buku</a>
                    </div>
                </div>
            </div>

            <!-- Card for Shopping Cart -->
            <div class="col-md-6 col-lg-4 mb-4 mx-2">
                <div class="card shadow-lg h-100">
                    <div class="card-header bg-warning text-white">
                        <h4 class="card-title">Keranjang Saya</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Cek keranjang belanja Anda. Pastikan buku yang Anda pilih sudah lengkap sebelum melakukan pembelian.</p>
                        <a href="{{ route('cart.index') }}" class="btn btn-light btn-block">Keranjang Saya</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
