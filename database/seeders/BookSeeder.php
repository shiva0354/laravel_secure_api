<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 5; $i++) {
            DB::table('books')->insert([
                'isbn' => random_int(0000000000000, 9999999999999),
                'title' => Str::random(10),
                'language' => 'english',
                'publisher' => 'TMH',
                'author' => 'shiva kumar',
                'user_id' => '1',
            ]);
        }
    }
}
