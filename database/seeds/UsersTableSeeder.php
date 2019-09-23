<?php

use Bimenu\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email'=>'hbmemati@gmail.com',
            'name' =>'Muhammet',
            'surname'=>'Balkırkan',
            'phone'=>'5558998123' ,
            'country'=>'Uşak',
            'authority'=>'1',
            'photo'=>'',
            'password'=>''
        ]);
    }
}
