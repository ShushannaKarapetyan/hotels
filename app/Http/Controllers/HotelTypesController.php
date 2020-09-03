<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelTypesSyncRequest;
use App\HotelType;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;

class HotelTypesController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|JsonResponse|View
     */
    public function index(Request $request)
    {
        $hotelTypes = HotelType::orderBy('type');

        if ($request->search_query) {
            $searchQuery = escape_like($request->search_query);
            $hotelTypes->where('type', 'like', '%' . $searchQuery . '%');
        }

        $hotelTypes = $hotelTypes->pluck('type', 'id');

        if ($request->wantsJson()) {
            return response()->json([
                'data' => $hotelTypes,
            ]);
        }

        return view('hotel-types.index', [
            'hotelTypes' => $hotelTypes,
            'searchQuery' => @$searchQuery,
        ]);
    }

    /**
     * @param HotelTypesSyncRequest $request
     * @return RedirectResponse
     */
    public function sync(HotelTypesSyncRequest $request)
    {
        $hotelTypesData = [];
        $now = Carbon::now();

        $requestHotelTypeIds = array_keys($request->hotel_types);
        $hotelTypesToDelete = HotelType::whereNotIn('id', $requestHotelTypeIds)->pluck('id');
        $existingHotelTypes = HotelType::whereIn('id', $requestHotelTypeIds)->get();

        $newHotelTypes = array_filter($request->hotel_types, function ($index) {
            return strpos($index, 'temp_') === 0;
        }, ARRAY_FILTER_USE_KEY);

        foreach ($existingHotelTypes as $hotelType) {
            if ($hotelType->type !== $request->hotel_types[$hotelType->id]) {
                $hotelType->type = $request->hotel_types[$hotelType->id];
                $hotelType->save();
            }
        }

        foreach ($newHotelTypes as $hotelType) {
            $hotelTypesData[] = [
                'type' => $hotelType,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        HotelType::insert($hotelTypesData);

        HotelType::whereIn('id', $hotelTypesToDelete)->delete();

        flash('HotelTypes have been successfully updated.', 'success');

        return redirect()->route('hotel_types');
    }
}
