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
            'photos'=>"[\"https://www.kadinlarkulubu.com/forum/attachments/domatesli-makarna-1-png.1957298/\", \"name2\", \"name3\"]",
            'product_id'=>"1",
            'category_id'=>"1",
        ]);

        Items::create([
            'name'=>"Tavuk",
            'description'=>"Tavuk yemeği işte ne bekliyon",
            'enabled'=>"1",
            'price'=>"5",
            'photos'=>"[\"http://www.gerdangurme.com/images/tavuk/kizarmis-hindi.jpg\", \"name2\", \"name3\"]",
            'product_id'=>"1",
            'category_id'=>"1",
        ]);

        Items::create([
            'name'=>"Bükme",
            'description'=>"Afyon bükmesi mis gibi vala",
            'enabled'=>"1",
            'price'=>"5",
            'photos'=>"[\"https://www.neyemekyapsak.com/wp-content/uploads/2017/07/afyon-b%C3%BCkme-tarifi2.jpg\", \"name2\", \"name3\"]",
            'product_id'=>"1",
            'category_id'=>"2",
        ]);

        Items::create([
            'name'=>"Kazandibi",
            'description'=>"En sevdiğim dadlıdır kensdisi beter güzel",
            'enabled'=>"1",
            'price'=>"5",
            'photos'=>"[\"https://lezzet.blob.core.windows.net/images-xxlarge-recipe/kazandibi-ca111b9b-4936-4049-9150-990ef28039d0.jpg\", \"name2\", \"name3\"]",
            'product_id'=>"1",
            'category_id'=>"3",
        ]);

        Items::create([
            'name'=>"Çay",
            'description'=>"Dumanı üstünde gelmezse geri yolla bubam",
            'enabled'=>"1",
            'price'=>"5",
            'photos'=>"[\"https://media-cdn.t24.com.tr/media/library/2019/04/1556455063389-cay.jpg\", \"name2\", \"name3\"]",
            'product_id'=>"1",
            'category_id'=>"4",
        ]);

        Items::create([
            'name'=>"yemek1",
            'description'=>"Dumanı üstünde gelmezse geri yolla bubam",
            'enabled'=>"1",
            'price'=>"5",
            'photos'=>"[\"https://media-cdn.t24.com.tr/media/library/2019/04/1556455063389-cay.jpg\", \"name2\", \"name3\"]",
            'product_id'=>"1",
            'category_id'=>"1",
        ]);

        Items::create([
            'name'=>"yemek2 le",
            'description'=>"Dumanı üstünde gelmezse geri yolla bubam",
            'enabled'=>"1",
            'price'=>"5",
            'photos'=>"[\"https://media-cdn.t24.com.tr/media/library/2019/04/1556455063389-cay.jpg\", \"name2\", \"name3\"]",
            'product_id'=>"1",
            'category_id'=>"1",
        ]);

        Items::create([
            'name'=>"yemek4",
            'description'=>"Dumanı üstünde gelmezse geri yolla bubam",
            'enabled'=>"1",
            'price'=>"5",
            'photos'=>"[\"https://media-cdn.t24.com.tr/media/library/2019/04/1556455063389-cay.jpg\", \"name2\", \"name3\"]",
            'product_id'=>"1",
            'category_id'=>"1",
        ]);
    }
}
