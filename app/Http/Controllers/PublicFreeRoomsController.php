<?php

namespace App\Http\Controllers;

use App\FreeRoom;
use App\Hotel;
use App\Http\Requests\FreeRoomsRequest;
use App\Room;
use App\Support\DateGetter;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PublicFreeRoomsController extends Controller
{
    /**
     * @param $uuid
     * @return Factory|View
     */
    public function index($uuid)
    {
        $hotel = Hotel::where('uuid', $uuid)->first();

        if (!$hotel) {
            abort(404);
        }

        $rooms = Room::where('hotel_id', $hotel->id)->get();

        $firstDay = Carbon::now()->startOfDay();
        $lastDay = Carbon::now()->addWeeks(2)->endOfWeek();
        $allDays = DateGetter::getDates($firstDay, $lastDay);
        $weekNumbers = weekNumbers($allDays);

        $freeRooms = [];

        foreach ($rooms as $room) {
            $freeRooms[] = FreeRoom::where('room_id', $room->id)->get();
        }

        $freeRoomsByWeeks = [];

        foreach ($freeRooms as $freeRoom) {
            $freeRoomsByWeeks[] = $freeRoom->groupBy(function ($date) {
                return Carbon::parse($date->date)->format('W');
            });
        }

        if (count($freeRoomsByWeeks[0]) && array_keys(end($freeRoomsByWeeks[0]))[count($freeRoomsByWeeks[0]) - 1] !== $weekNumbers[2]) {
            foreach ($rooms as $room) {
                foreach ($allDays[2] as $day) {
                    FreeRoom::create([
                        'room_id' => $room->id,
                        'free' => 0,
                        'date' => $day,
                    ]);
                }
            }
        }

        return view('hotel-rooms._free-rooms', compact([
            'hotel',
            'uuid',
            'rooms',
            'allDays',
            'weekNumbers',
            'freeRoomsByWeeks',
        ]));
    }

    /**
     * @param $uuid
     * @param FreeRoomsRequest $request
     * @return RedirectResponse
     */
    public function update($uuid, FreeRoomsRequest $request)
    {
        $hotel = Hotel::where('uuid', $uuid)->first();

        $rooms = Room::where('hotel_id', $hotel->id)->pluck('id');

        $freeRooms = [];

        $roomIds = Room::where('hotel_id', $hotel->id)->pluck('id');

        foreach ($roomIds as $roomId) {
            $freeRooms[] = FreeRoom::where('room_id', $roomId)->get();
        }

        if (count($freeRooms[0]) === 0) {
            foreach ($roomIds as $roomId) {
                foreach (array_values($request->free_rooms[$roomId]) as $i => $freeRoom) {
                    FreeRoom::create([
                        'room_id' => $roomId,
                        'free' => $freeRoom,
                        'date' => array_keys($request->free_rooms[$roomId])[$i],
                    ]);
                }
            }
        }

        foreach ($rooms as $room) {
            foreach (array_values($request->free_rooms[$room]) as $i => $freeRoom) {
                FreeRoom::where('room_id', $room)
                    ->where('date', array_keys($request->free_rooms[$room])[$i])
                    ->update([
                        'free' => $freeRoom,
                    ]);
            }
        }

        $hotel->update([
            'rooms_updated_at' => Carbon::now()->format('Y-m-d'),
        ]);

        flash('FreeRooms have been successfully updated.', 'success');

        return redirect()->route('public_free_rooms', $uuid);
    }
}
