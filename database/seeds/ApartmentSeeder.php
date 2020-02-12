<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\User;
use App\Service;
use App\Promo;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Apartment::class, 50)
            ->make()
            ->each(function($apartment) {
                $user = User::inRandomOrder() -> first();
                $apartment -> user() -> associate($user);
                $apartment -> save();
                
            })

            -> each(function($apartment){
                $services = Service::inRandomOrder() -> take(rand(0,6)) -> get();
                $apartment -> services() -> attach($services);
                })

            -> each(function($apartment){
                $promos = Promo::inRandomOrder() -> take(rand(0,1)) -> get();
                $apartment -> promos() -> attach($promos);
            });
    }
}
