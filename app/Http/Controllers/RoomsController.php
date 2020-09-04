<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Room;
use App\Http\Requests\RoomRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Carbon\Carbon;

class RoomsController extends Controller
{
    /**
     * @param Hotel $hotel
     * @return Factory|View
     */
    public function index(Hotel $hotel)
    {
        $rooms = Room::where('hotel_id', $hotel->id);

        if (request()->search_query) {
            $searchQuery = escape_like(request()->search_query);

            $rooms->where('name', 'LIKE', '%' . $searchQuery . '%')
                ->orderByDesc('created_at')->get();
        }

        $rooms = $rooms->get();

        foreach ($rooms as $room) {
            $roomsWithIdKeys[$room->id] = $room;
        }

        return view('rooms.index', [
            'roomsWithIdKeys' => @$roomsWithIdKeys,
            'hotel' => $hotel,
            'searchQuery' => @$searchQuery,
        ]);
    }

    /**
     * @param RoomRequest $request
     * @param Hotel $hotel
     * @return mixed
     */
    public function sync(RoomRequest $request, Hotel $hotel)
    {
        $roomsData = [];
        $now = Carbon::now();

        $requestRoomIds = array_keys($request->rooms);

        $roomsToDelete = Room::whereNotIn('id', $requestRoomIds)
            ->where('hotel_id', $hotel->id)
            ->pluck('id');

        $existingRooms = Room::whereIn('id', $requestRoomIds)
            ->where('hotel_id', $hotel->id)
            ->get();

        $newRooms = array_filter($request->rooms, function ($index) {
            return strpos($index, 'temp_') === 0;
        }, ARRAY_FILTER_USE_KEY);

        foreach ($existingRooms as $room) {
            if ($room->name !== $request->rooms[$room->id]['name']) {
                $room->name = $request->rooms[$room->id]['name'];
                $room->save();
            }

            if ($room->adults !== $request->rooms[$room->id]['adults']) {
                $room->adults = $request->rooms[$room->id]['adults'];
                $room->save();
            }

            if ($room->children !== $request->rooms[$room->id]['children']) {
                $room->children = $request->rooms[$room->id]['children'];
                $room->save();
            }
        }

        foreach ($newRooms as $room) {
            $roomsData[] = [
                'hotel_id' => $hotel->id,
                'name' => $room['name'],
                'adults' => $room['adults'],
                'children' => $room['children'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        Room::insert($roomsData);

        Room::whereIn('id', $roomsToDelete)->delete();

        flash('Rooms have been successfully updated.', 'success');

        return redirect()->route('rooms', $hotel);
    }
}
