<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Publisher::create([
            'name' => 'Gramedia Pustaka Utama',
            'desc' => 'Dummy Data',
        ]);

        \App\Models\Publisher::create([
            'name' => 'Mizan Publishing',
            'desc' => 'Dummy Data',
        ]);

        \App\Models\Publisher::create([
            'name' => 'Penerbit Erlangga',
            'desc' => 'Dummy Data',
        ]);
    }
}
