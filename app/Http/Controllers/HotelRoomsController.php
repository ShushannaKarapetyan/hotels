<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\HotelRoom;
use App\Http\Requests\HotelRoomRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HotelRoomsController extends Controller
{
    /**
     * @param Hotel $hotel
     * @return Factory|View
     */
    public function create(Hotel $hotel)
    {
        return view('hotel-rooms.create', compact('hotel'));
    }

    /**
     * @param HotelRoomRequest $request
     * @param Hotel $hotel
     * @return RedirectResponse
     */
    public function store(HotelRoomRequest $request, Hotel $hotel)
    {
        foreach ($request->rooms as $index => $room) {
            HotelRoom::create([
                'hotel_id' => $hotel->id,
                'name' => $room['name'],
                'adults' => $room['adults'],
                'children' => $room['children'],
            ]);
        }

        flash('Rooms have been successfully created.', 'success');

        return redirect()->route('hotel.rooms', $hotel);
    }

    /**
     * @param Hotel $hotel
     * @param HotelRoom $room
     * @return Factory|View
     */
    public function edit(Hotel $hotel, HotelRoom $room)
    {
        return view('hotel-rooms.edit', compact([
            'hotel',
            'room',
        ]));
    }

    /**
     * @param HotelRoomRequest $request
     * @param Hotel $hotel
     * @param HotelRoom $room
     * @return RedirectResponse
     */
    public function update(HotelRoomRequest $request, Hotel $hotel, HotelRoom $room)
    {
        $requestData = array_values($request->rooms)[0];

        $roomData = [
            'hotel_id' => $hotel->id,
            'name' => $requestData['name'],
            'adults' => $requestData['adults'],
            'children' => $requestData['children'],
        ];

        $room->update($roomData);

        flash('Room has been successfully updated.', 'success');

        return redirect()->route('hotel.rooms', $hotel);
    }

    /**
     * @param Hotel $hotel
     * @param HotelRoom $room
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Hotel $hotel, HotelRoom $room)
    {
        $room->delete();

        flash('Room has been successfully deleted.', 'success');

        return back();
    }
}
