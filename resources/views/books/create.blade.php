@extends('layouts.app')

@section('title', 'Tambah Buku Baru')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title">Tambah Buku Baru</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('books.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="title" class="form-label">Judul Buku</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Masukkan judul buku" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="author" class="form-label">Penulis</label>
                            <input type="text" name="author" id="author" class="form-control" placeholder="Masukkan nama penulis" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="category" class="form-label">Kategori</label>
                            <input type="text" name="category" id="category" class="form-control" placeholder="Masukkan kategori buku" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <input type="number" name="price" id="price" class="form-control" placeholder="Masukkan harga buku" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="stock" class="form-label">Stok</label>
                            <input type="number" name="stock" id="stock" class="form-control" placeholder="Masukkan jumlah stok" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ route('books.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
