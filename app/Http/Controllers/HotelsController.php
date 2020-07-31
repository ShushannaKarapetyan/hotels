<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\HotelRoom;
use App\HotelType;
use App\Http\Requests\HotelRequest;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HotelsController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $hotels = Hotel::query();

        if ($request->search_query) {
            $searchQuery = escape_like($request->search_query);
            $hotels->where('name', 'like', '%' . $searchQuery . '%');
        }

        $hotels = $hotels->orderByDesc('created_at')->paginate(25);

        return view('hotels.index', [
            'hotels' => $hotels,
            'searchQuery' => @$searchQuery,
        ]);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $types = HotelType::pluck('type', 'id')->toArray();

        return view('hotels.create', compact('types'));
    }

    /**
     * @param HotelRequest $request
     * @return RedirectResponse
     */
    public function store(HotelRequest $request)
    {
        $hotelData = $request->only([
            'type_id',
            'name',
            'email',
            'phone',
            'address',
        ]);

        Hotel::create($hotelData);

        flash('Hotel has been successfully created.', 'success');

        return redirect()->route('hotels');
    }

    /**
     * @param Hotel $hotel
     * @return Factory|View
     */
    public function edit(Hotel $hotel)
    {
        $types = HotelType::pluck('type', 'id')->toArray();

        return view('hotels.edit', compact([
            'hotel',
            'types',
        ]));
    }

    /**
     * @param HotelRequest $request
     * @param Hotel $hotel
     * @return RedirectResponse
     */
    public function update(HotelRequest $request, Hotel $hotel)
    {
        $hotelData = $request->only([
            'type_id',
            'name',
            'email',
            'phone',
            'address',
        ]);

        $hotel->update($hotelData);

        flash('Hotel has been successfully updated.', 'success');

        return redirect()->route('hotels');
    }

    /**
     * @param Hotel $hotel
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();

        flash('Hotel has been successfully deleted.', 'success');

        return redirect()->route('hotels');
    }

    /**
     * @param Hotel $hotel
     * @return Factory|View
     */
    public function rooms(Hotel $hotel)
    {
        $rooms = HotelRoom::where('hotel_id', $hotel->id)->paginate(20);

        if (request()->search_query) {
            $searchQuery = escape_like(request()->search_query);
            $rooms = HotelRoom::query()->where('name', 'like', '%' . $searchQuery . '%')
                ->where('hotel_id', $hotel->id)
                ->orderByDesc('created_at')
                ->paginate(10);
        }

        return view('hotels.rooms', [
            'rooms' => $rooms,
            'hotel' => $hotel,
        ]);
    }
}
