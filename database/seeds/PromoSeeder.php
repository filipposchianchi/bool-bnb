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
        factory(Promo::class, 35)
            ->make()
            ->each(function($promo) {
                $apartment = Apartment::inRandomOrder() -> first();
                $promo -> apartment() -> associate($apartment);
                $promo -> save();
            });
    }
}
