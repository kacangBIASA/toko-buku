<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    // Menambahkan user_id ke dalam $fillable untuk memungkinkan mass assignment
    protected $fillable = [

        'book_id',
        'quantity',
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan model Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
