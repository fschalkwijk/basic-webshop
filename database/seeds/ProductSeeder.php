<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        factory(\App\Product::class)->create(['vat_percentage' => 0]);
        factory(\App\Product::class)->create(['vat_percentage' => 0.06]);
        factory(\App\Product::class)->create(['vat_percentage' => 0.21]);

        factory(\App\Product::class, 20)->create();
    }
}
