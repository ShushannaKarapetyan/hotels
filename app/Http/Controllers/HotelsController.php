<?php

namespace App\Http\Controllers;

use App\FreeRoom;
use App\Hotel;
use App\Http\Requests\HotelFiltersRequest;
use App\HotelType;
use App\Http\Requests\HotelRequest;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Builder;
use PDF;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

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
     * @param HotelFiltersRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function getFilteredHotels(HotelFiltersRequest $request)
    {
        if ($request->wantsJson()) {
            $hotels = Hotel::whereHas('rooms', function (Builder $query) use ($request) {
                $query->where('adults', $request->adults)
                    ->where('children', $request->children)
                    ->whereHas('freeRoom', function (Builder $query) use ($request) {
                        $query->where('free', '>', 0)
                            ->where('date', '>=', Carbon::parse($request->from))
                            ->where('date', '<=', Carbon::parse($request->to));
                    });
            })->where('type_id', $request->type)
                ->with('rooms')
                ->get();

            return response()->json([
                'content' => view('hotels.filtered-hotels.index', compact('hotels'))->render(),
            ]);
        }
    }

    /**
     * @return BinaryFileResponse
     */
    public function generateInvoice()
    {
        $hotels = Hotel::with('rooms')->get();

        $filePath = storage_path('app/invoices/invoice_' . time() . '.pdf');

        foreach (call_user_func_array('array_merge', FreeRoomsController::allDays()) as $day) {
            $dates[] = Carbon::parse($day)->format('d.m.Y');
        }

        $freeRooms = FreeRoom::where('date', '>=', Carbon::now()->format('Y-m-d'))
            ->get()->groupBy('room_id');

        foreach ($freeRooms as $roomId => $freeRoom) {
            foreach ($freeRoom as $room) {
                $freeRoomsByRooms[$roomId][] = $room->free;
            }
        }

        PDF::loadView('hotels.invoice.invoice', compact([
            'hotels',
            'dates',
            'freeRoomsByRooms',
        ]))
            ->save($filePath);

        return response()->file($filePath, [
                'Content-Disposition' => 'inline; filename="invoice_' . time() . '"',
            ]
        );
    }
}
