<?php

use Bimenu\Customer;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            'name' =>'Muhammet',
            'surname'=>'Balkırkan',
            'phone'=>'1' ,
            'phone_verified'=>'1' ,
        ]);
    }
}
