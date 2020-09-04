<?php

namespace App\Http\Controllers;

use App\FreeRoom;
use App\Hotel;
use App\Room;
use App\Http\Requests\FreeRoomsRequest;
use App\Support\DateGetter;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FreeRoomsController extends Controller
{
    /**
     * @param Hotel $hotel
     * @return Factory|JsonResponse|View
     */
    public function index(Hotel $hotel)
    {
        $rooms = Room::where('hotel_id', $hotel->id)->get();

        [$allDays,
            $weekNumbers,
            $freeRoomsByWeeks
        ] = $this->getFreeRoomsData($rooms);

        return view('rooms.free-rooms.index', compact([
            'hotel',
            'rooms',
            'allDays',
            'weekNumbers',
            'freeRoomsByWeeks',
        ]));
    }

    /**
     * @param Hotel $hotel
     * @param FreeRoomsRequest $request
     * @return RedirectResponse
     */
    public function update(Hotel $hotel, FreeRoomsRequest $request)
    {
        $this->freeRoomsUpdate($hotel, $request);

        return redirect()->route('free_rooms', $hotel);
    }

    /**
     * @param $uuid
     * @return Factory|View
     */
    public function publicFreeRooms($uuid)
    {
        $hotel = Hotel::where('uuid', $uuid)->first();

        if (!$hotel) {
            abort(404);
        }

        $rooms = Room::where('hotel_id', $hotel->id)->get();

        [$allDays,
            $weekNumbers,
            $freeRoomsByWeeks
        ] = $this->getFreeRoomsData($rooms);

        return view('rooms.free-rooms.public.index', compact([
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
    public function publicFreeRoomsUpdate($uuid, FreeRoomsRequest $request)
    {
        $hotel = Hotel::where('uuid', $uuid)->first();

        $this->freeRoomsUpdate($hotel, $request);

        return redirect()->route('public_free_rooms', $uuid);
    }

    /**
     * @param $rooms
     * @return array
     */
    public function getFreeRoomsData($rooms)
    {
        $freeRoomsByWeeks = [];

        $allDays = $this->allDays();
        $weekNumbers = weekNumbers($allDays);

        if (count($rooms)) {
            foreach ($rooms as $room) {
                $roomIds[] = $room->id;
            }

            $freeRooms = FreeRoom::whereIn('room_id', $roomIds)
                ->where('date', '>=', Carbon::now()->format('Y-m-d'))
                ->get();

            $freeRoomsByRooms = $freeRooms->groupBy('room_id');

            foreach ($freeRoomsByRooms as $roomId => $freeRoomsByRoom) {
                $freeRoomsByWeeks[$roomId] = $freeRoomsByRooms[$roomId]->groupBy(function ($date) {
                    return Carbon::parse($date->date)->format('W');
                });
            }
        }

        return [
            $allDays,
            $weekNumbers,
            $freeRoomsByWeeks
        ];
    }

    /**
     * @param $hotel
     * @param $request
     */
    public function freeRoomsUpdate($hotel, $request)
    {
        $roomIds = Room::where('hotel_id', $hotel->id)->pluck('id');

        $now = Carbon::now();

        foreach ($roomIds as $roomId) {
            foreach ($request->free_rooms[$roomId] as $date => $free) {
                $dates[] = $date;

                $freeRoomData[] = [
                    'room_id' => $roomId,
                    'free' => $free,
                    'date' => $date,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        FreeRoom::whereIn('room_id', $roomIds)
            ->whereIn('date', $dates)
            ->delete();

        FreeRoom::insert($freeRoomData);

        $hotel->update([
            'rooms_updated_at' => $now->format('Y-m-d'),
        ]);

        flash('FreeRooms have been successfully updated.', 'success');
    }

    /**
     * @return array|JsonResponse
     */
    public static function allDays()
    {
        $firstDay = Carbon::now()->startOfDay();
        $lastDay = Carbon::now()->addWeeks(2)->endOfWeek();

        $allDays = DateGetter::getDates($firstDay, $lastDay);

        if (request()->wantsJson()) {
            foreach (call_user_func_array('array_merge', $allDays) as $day) {
                $formattedDates[] = Carbon::parse($day)->format('d M, D');
            }

            return response()->json([
                'data' => $formattedDates,
            ]);
        }

        return $allDays;
    }
}
