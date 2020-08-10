<?php

namespace App\Support;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class DateGetter
{
    /**
     * @param $firstDay
     * @param $lastDay
     * @return array
     */
    public static function getDates($firstDay, $lastDay)
    {
        $period = CarbonPeriod::since($firstDay)->week()->until($lastDay);

        $dates = [];

        foreach ($period as $date) {
            array_push($dates,
                [
                    'start' => $date->startOfWeek()->format('Y-m-d'),
                    'end' => $date->endOfWeek()->format('Y-m-d'),
                ]
            );

            $dates[0]['start'] = Carbon::today()->format('Y-m-d');
        }

        foreach ($dates as $index => $date) {
            $dateRanges[] = CarbonPeriod::create($date['start'], $date['end']);

            foreach ($dateRanges[$index] as $ranges) {
                $range[$index][] = $ranges->format('Y-m-d');
            }

            $allDays[] = $range[$index];
        }

        return $allDays;
    }
}
