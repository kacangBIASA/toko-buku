@extends('layouts.app')
@extends('layouts.footer')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center mb-4 text-primary font-weight-bold">Customer Dashboard</h2>
        </div>

        <!-- Card for Book Listings -->
        <div class="d-flex justify-content-center">
            <div class="col-md-6 col-lg-4 mb-4 mx-2">
                <div class="card shadow-lg h-100">
                    <div class="card-header bg-info text-white">
                        <h4 class="card-title">Kelola Buku</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Kelola semua buku yang tersedia di toko Anda, mulai dari menambah, mengedit, hingga menghapus buku.</p>
                        <a href="{{ route('books.index') }}" class="btn btn-light btn-block">Kelola Buku</a>
                    </div>
                </div>
            </div>

            <!-- Card for Shopping Cart -->
            <div class="col-md-6 col-lg-4 mb-4 mx-2">
                <div class="card shadow-lg h-100">
                    <div class="card-header bg-warning text-white">
                        <h4 class="card-title">Tambah Buku Baru</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Tambahkan buku baru yang ingin Anda jual.</p>
                        <a href="{{ route('books.create') }}" class="btn btn-light btn-block">Tambah Buku</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
