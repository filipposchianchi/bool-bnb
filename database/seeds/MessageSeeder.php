<?php

use Illuminate\Database\Seeder;
use App\Message;
use App\User;
class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Message::class, 100)
        ->make()
        ->each(function($Message) {
            $user = User::inRandomOrder() ->first();
            $Message -> user() -> associate($user);
            $Message -> save();
        });
    }
}
