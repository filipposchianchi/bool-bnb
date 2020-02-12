<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\Promo;
class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $promos = [
            ['type' => 'a'],
            ['type' => 'b'],
            ['type' => 'c']
             
        ];


        foreach ($promos as $promo)
        {
            $newPromo = new Promo;
            $newPromo -> fill($promo);
            $newPromo -> save();
            
        }
    }
}
