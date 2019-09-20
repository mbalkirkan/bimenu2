<?php
use Illuminate\Database\Seeder;
use Bimenu\Qrcode;
use Illuminate\Support\Facades\Hash;
use App\Models\Language\Language;
use App\Models\Country\Country;
class QrCodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i = 0; $i < 10; $i++) {
            Qrcode::create([
                'product_id'=>10,
                 'product_table_id'=>1

            ]);
        }
    }
}
