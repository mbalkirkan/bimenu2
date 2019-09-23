<?php

use Bimenu\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name'=>"Cafe Latte",
            'description'=>"Heykelin Karşısında Cafe",
            'type'=>"cafe",
            'country'=>"Uşak",
            'photos'=>"[\"https://i.nefisyemektarifleri.com/2015/03/21/cafe-latte-susleme.jpg\", \"name2\", \"name3\"]",
            'phone'=>"5555555555",
            'address'=>"Uşak Merkez Caddesi",
            'maps_address'=>1,
        ]);
    }
}
