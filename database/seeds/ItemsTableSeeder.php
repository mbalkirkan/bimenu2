<?php

use Bimenu\Items;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Items::create([
            'name'=>"Makarna",
            'description'=>"Tatlı bir keyif",
            'enabled'=>"1",
            'price'=>"5",
            'photos'=>"[\"name1\", \"name2\", \"name3\"]",
            'product_id'=>"1",
            'category_id'=>"1",
        ]);
    }
}
