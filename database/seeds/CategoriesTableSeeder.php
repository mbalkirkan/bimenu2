<?php

use Bimenu\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $names=['Yemekler','Ara Sıcaklar','Tatlılar',
        'Sıcak İçecekler','Soğuk İçecekler'];
        $descriptions=['Ana Yemekler',
            'Atıştırmalık Aparatifler',
            'En Tatlı Anlar İçin Bir Tatlı..',
            'İçinizi Isıtacak..',
            'Serin Bir Lezzet'];
        foreach ($names as $key=>$name)
        {
            Category::create([
                'name'=>$name,
                'description'=>$descriptions[$key],
                'product_id'=>1
            ]);
        }

    }
}
