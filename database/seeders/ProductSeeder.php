<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'A',
                'price' => '30'
            ],
            [
                'name' => 'B',
                'price' => '20'
            ],
            [
                'name' => 'C',
                'price' => '50'
            ],
            [
                'name' => 'D',
                'price' => '15'
            ],
        ]);
    }
}
