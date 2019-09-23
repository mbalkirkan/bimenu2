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
        for($i = 0; $i < 10; $i++) {
            ProductTable::create([
                'product_id' => '1',
                'name' => "Salon Masa ".$i,
                'enabled' => "1",
            ]);
        }
    }
}
