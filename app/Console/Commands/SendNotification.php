<?php

namespace App\Console\Commands;

use App\Hotel;
use App\Manager;
use App\Notifications\ManagerNotification;
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

        $roomsUpdatedAt = Hotel::pluck('rooms_updated_at', 'id');

        foreach ($roomsUpdatedAt as $hotelId => $updatedAt) {
            if (strtotime($updatedAt) < strtotime('-2 weeks')) {
                $managers[] = Manager::where('hotel_id', $hotelId)->first();
            }
        }

        foreach ($managers as $manager) {
            $manager->notify(new ManagerNotification($manager->hotel->uuid));
        }
    }
}
