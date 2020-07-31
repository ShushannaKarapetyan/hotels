<?php

namespace App\Http\Controllers;

use App\FreeRoom;
use App\Hotel;
use App\HotelRoom;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FreeRoomsController extends Controller
{
    public function index(Hotel $hotel)
    {
        $rooms = HotelRoom::all()->unique('name');

        $firstDay = Carbon::now()->startOfDay();

        $lastDay = Carbon::now()->addWeeks(2)->endOfWeek();

        $period = CarbonPeriod::since($firstDay)->week()->until($lastDay);

        $dates = [];
        $start = 'startOfWeek';
        $end = 'endOfWeek';

        foreach ($period as $date) {
            array_push($dates,
                [
                    'start' => $date->$start()->format('Y-m-d H:i:s'),
                    'end' => $date->$end()->format('Y-m-d H:i:s'),
                ]
            );
        }

        //dd($dates);


        return view('hotel-rooms.free-rooms', compact([
            'hotel',
            'rooms',
            //'freeRooms',
        ]));
    }

}
