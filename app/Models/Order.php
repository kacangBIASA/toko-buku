<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',       // Nama pelanggan
        'address',    // Alamat pelanggan
        'phone',      // Nomor telepon pelanggan
        'total_price', // Total harga pesanan
    ];

    // Relasi dengan buku
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
