<?php

namespace App\Console\Commands;

use App\Hotel;
use App\Notifications\ManagerNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Sends notifications every sunday to managers who didn't update free rooms in last 2 weeks.";

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
     * @return void
     */
    public function handle()
    {
        $this->line("Sends notification...");

        $hotels = Hotel::with('manager')
            ->where('rooms_updated_at', '<', Carbon::now()->subWeeks(2))
            ->get();

        foreach ($hotels as $hotel) {
            $hotel->manager->notify(new ManagerNotification($hotel->uuid));
        }
    }
}
