<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::factory(50)->create();
        // DB::table('books')->insert([
        //     [
        //         'title' => 'Laravel for Beginners',
        //         'author' => 'John Doe',
        //         'price' => 150000,
        //         'stock' => 10,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'title' => 'Mastering PHP',
        //         'author' => 'Jane Smith',
        //         'price' => 200000,
        //         'stock' => 5,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'title' => 'Web Development with Bootstrap',
        //         'author' => 'Richard Roe',
        //         'price' => 175000,
        //         'stock' => 8,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ]);
    }
}
