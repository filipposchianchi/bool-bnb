<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\Service;
class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Service::class, 100) ->make() -> each(function($service){
            $apartment = Apartment::inRandomOrder() -> first();
            $service -> apartment() -> associate($apartment);
            $service -> save();
        });
    }
}
