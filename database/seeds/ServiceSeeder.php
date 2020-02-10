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
        $services = [
            ['name' => 'WiFi'],
            ['name' => 'Posto Macchina'],
            ['name' => 'Piscina'],
            ['name' => 'Portineria'],
            ['name' => 'Sauna'],
            ['name' => 'Vista Mare']
             
        ];


        foreach ($services as $service)
        {
            $newService = new Service;
            $newService -> fill($service);
            $newService -> save();
            
        }
    }
}
