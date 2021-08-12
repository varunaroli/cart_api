<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discounts')->insert([
            [
            'product_id' => '1',
            'min_value' => '3',
            'max_value' => '100',
            'discount_amount' => '5',
            'discount_type' => '0'
            ],
            [
            'product_id' => '2',
            'min_value' => '2',
            'max_value' => '100',
            'discount_amount' => '2.5',
            'discount_type' => '0'
            ],
            [
            'product_id' => NULL,
            'min_value' => '150',
            'max_value' => '1000',
            'discount_amount' => '20',
            'discount_type' => '1'
            ]]);

        }
}
