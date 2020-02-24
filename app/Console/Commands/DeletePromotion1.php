<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Apartment;

class DeletePromotion1 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete the promo after one day';

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
        $apartments = Apartment::all();
        foreach ($apartments as $apartment) {
            if($apartment -> sponsored == 1) {
                $apartment -> sponsored = 0;
            }
        }
    }
}
