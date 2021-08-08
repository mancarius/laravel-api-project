<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\WasteDay;
use Illuminate\Support\Facades\Validator;

class DayController extends Controller
{
    /**
     * Return the collected wastes for every day.
     *
     * @return \App\Models\Day
     */
    public function index()
    {
        try{
            return [ 'days' => Day::with('wastes')->get() ];
        } catch(\Exception $e) {
            return response('', 500);
        }
    }


    /**
     * Return the collected wastes in the given day.
     *
     * @param string $day day of week
     * @return \App\Models\Day
     */
    public function show($day)
    {
        $validator = Validator::make(['day' => $day], [
            'day' => 'exists:App\Models\Day,name'
        ]);

        if ($validator->fails()) {
            return response()
                        ->json([
                            'message' => $validator->errors()->all()
                        ], 400);
        }

        try{
            return response()->json([
                'wastes' => Day::where('name', $day)->first()->wastes
            ]);
        } catch(\Exception $e) {
            return response('', 500);
        }
    }
    
    /**
     * Returns true if the given waste pick-up is scheduled in the given day.
     *
     * @param int $waste_id
     * @param int $day_id
     * @return boolean
     */
    static function isWasteInDay($waste_id, $day_id): bool
    {
        try {
            return !! WasteDay::where('waste_id', $waste_id)->where('day_id', $day_id)->count();
        } catch(\Exception $e) {
            return false;
        }
    }

    /**
     * Checks if the required time interval is free in the given day
     *
     * @param int $day_id
     * @param string $time_start
     * @param string $time_end
     * @param string $pick_up_to_exclude The pick up key to exclude from the calculation (optional)
     * @return boolean
     */
    static function isSlotAvailableInDay($day_id, $time_start, $time_end, $pick_up_to_exclude = ''): bool
    {
        $new_time_start = new \DateTime($time_start);
        $new_time_end   = new \DateTime($time_end);
        $wastes_pick_up = Day::findOrFail($day_id)->wastes;

        function isTimeInInterval($time_test, $time_start, $time_end) {
            if( $time_start < $time_test && $time_end > $time_test )
                return true;
            else
                return false;
        }

        foreach ($wastes_pick_up as $waste) {
            if ($waste->pick_up_id === $pick_up_to_exclude)
                continue;
            $test_time_start = new \DateTime( $waste->pick_up_time_start );
            $test_time_end   = new \DateTime( $waste->pick_up_time_end );
            
            if ( isTimeInInterval($new_time_start, $test_time_start, $test_time_end) )
                return false;
            else if ( isTimeInInterval($new_time_end, $test_time_start, $test_time_end) )
                return false;
        }

        return true;
    }
}