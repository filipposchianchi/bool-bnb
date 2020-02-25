<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Apartment;
use Carbon\Carbon;

class DeletePromotion1 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:deletepromo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete the promo after 24 or 72 or 144 hours';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //echo Carbon::now()->addDay(1);
        $apartments = Apartment::all();
        foreach ($apartments as $apartment) { 

            switch($apartment -> sponsored) {

                case 1:
                    if(Carbon::parse($apartment -> startDaySponsor) -> addDay(1) < Carbon::now() ) {
                        $apartment -> sponsored = 0;
                        $apartment->update();
                    }
                break;
                case 2:
                    if(Carbon::parse($apartment -> startDaySponsor) -> addDay(3) < Carbon::now() ) {
                        $apartment -> sponsored = 0;
                        $apartment->update();
                    }
                break;
                case 3;
                    if(Carbon::parse($apartment -> startDaySponsor) -> addDay(6) < Carbon::now() ) {
                        $apartment -> sponsored = 0;
                        $apartment->update();
                    }
                break;
            }

        }


    }
}
