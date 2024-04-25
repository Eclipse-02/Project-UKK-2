<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookshelfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Bookshelf::create([
            'book_id' => 1,
            'user_id' => 3,
            'status' => 'L'
        ]);

        \App\Models\Bookshelf::create([
            'book_id' => 2,
            'user_id' => 3,
            'status' => 'F'
        ]);
    }
}
