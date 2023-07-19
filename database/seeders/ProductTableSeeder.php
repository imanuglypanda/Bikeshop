<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert(array(
            [
                'code' => 'P004',
                'name' => 'A4', 'category_id' => 2,
                'price' => 50000,
                'stock_qty' => 2,
            ],
            [
                'code' => 'P005',
                'name' => 'A5', 'category_id' => 3,
                'price' => 300,
                'stock_qty' => 4,
            ],
            [
                'code' => 'P006',
                'name' => 'A6', 'category_id' => 3,
                'price' => 300,
                'stock_qty' => 7,
            ],
            [
                'code' => 'P007',
                'name' => 'A7', 'category_id' => 4,
                'price' => 7899,
                'stock_qty' => 5,
            ],
            [
                'code' => 'P008',
                'name' => 'A8', 'category_id' => 5,
                'price' => 1299,
                'stock_qty' => 4,
            ],
            [
                'code' => 'P009',
                'name' => 'A9', 'category_id' => 6,
                'price' => 6500,
                'stock_qty' => 2,
            ],
        ));
    }
}
