<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Apartment;
use App\Message;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 49) ->create();
    }
}
