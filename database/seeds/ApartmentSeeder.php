<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\User;
use App\Service;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Apartment::class, 10)
            ->make()
            ->each(function($apartment) {
                $user = User::inRandomOrder() -> first();
                $apartment -> user() -> associate($user);
                $apartment -> save();
                
            })

            -> each(function($apartment){
                $services = Service::inRandomOrder() -> take(rand(0,6)) -> get();
                $apartment -> services() -> attach($services);
                });
    }
}
