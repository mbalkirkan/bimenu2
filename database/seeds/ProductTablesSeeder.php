<?php
use Bimenu\ProductTable;
use Illuminate\Database\Seeder;

class ProductTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductTable::create([
            'product_id'=>'1',
            'name'=>"Salon Masa 1",
            'enabled'=>"1",
        ]);
    }
}
