<?php

namespace App\Http\Controllers;

use App\Models\WasteDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WasteDayController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dayId' => 'bail|required|exists:App\Models\Day,id',
            'wasteId' => 'bail|required|exists:App\Models\Waste,id',
            'timeStart' => 'bail|required|date_format:G:i:s',
            'timeEnd' => 'bail|required|date_format:G:i:s|after:time_start'
        ]);

        if ($validator->fails()) {
            return response()
                        ->json([
                            'message' => $validator->errors()->all()
                        ], 400);
        }

        if (DayController::isWasteInDay($request->waste, $request->day))
        {
            return response()
                        ->json([
                            'message' => ["This pick-up already exist in this day."]
                        ], 400);
        }

        $is_slot_available = DayController::isSlotAvailableInDay($request->day, $request->time_start, $request->time_end);

        if (!$is_slot_available)
        {
            return response()
                        ->json([
                            'message' => ["This pick-up interval overlaps with another one."]
                        ], 400);
        }

        // create pick-up
        $waste_days = new WasteDay([
            'key' => bin2hex(random_bytes(20)),
            'waste_id' => $request->waste,
            'day_id' => $request->day,
            'pick_up_time_start' => $request->time_start,
            'pick_up_time_end' => $request->time_end
        ]);

        $waste_days->save();

        $waste_days->refresh();

        $json_response = json_encode([
            'pick_up' => [
                'id' => $waste_days->key
            ]
        ]);

        return response()->json($json_response, 201);
    }


    public function update(Request $request, $key)
    {
        $pick_up = $request->all();
        $pick_up['key'] = $key;

        $validator = Validator::make($pick_up, [
            'key' => 'bail|required|exists:App\Models\WasteDay,key',
            'timeStart' => 'bail|required_without:timeEnd|date_format:G:i:s',
            'timeEnd' => 'bail|required_without:timeStart|date_format:G:i:s|after:time_start'
        ]);

        if ($validator->fails()) {
            return response()
                        ->json([
                            'message' => $validator->errors()->all()
                        ], 400);
        }

        $waste_days = WasteDay::where('key', $pick_up['key'])->first();
        
        // time start - check and assign
        if( isset($pick_up['timeStart']) ) {

            $time_end = isset($pick_up['timeEnd']) ? $pick_up['timeEnd'] : $waste_days->pick_up_time_end;

            if( strtotime($pick_up['timeStart']) > strtotime($time_end) ) {
                return response()
                            ->json([
                                "message" => ["timeStart can't be greater than timeEnd"]
                            ], 400);
            }

            $waste_days->pick_up_time_start = $pick_up['timeStart'];
        }
        // time end - check and assign
        if( isset($pick_up['timeEnd']) ) {

            $time_start = isset($pick_up['timeStart']) ? $pick_up['timeStart'] : $waste_days->pick_up_time_start;

            if( strtotime($pick_up['timeEnd']) < strtotime($time_start) ) {
                return response()
                            ->json([
                                "message" => ["timeStart can't be greater than timeEnd"]
                            ], 400);
            }

            $waste_days->pick_up_time_end = $pick_up['timeStart'];
        }

        $is_slot_available = DayController::isSlotAvailableInDay(
                                    $waste_days->day_id, 
                                    $waste_days->pick_up_time_start, 
                                    $waste_days->pick_up_time_end, 
                                    $waste_days->key);

        if (!$is_slot_available)
        {
            return response()
                        ->json([
                            'message' => ["This pick up overlaps with another one."]
                        ], 400);
        }
        
        // update pick up
        try {
            $waste_days->save();
        } catch (\Exception $e) {
            return response('', 500);
        }

        return response('', 204);
    }


    public function destroy($key)
    {
        $validator = Validator::make(["key" => $key], [
            'key' => 'exists:App\Models\WasteDay,key',
        ]);

        if ($validator->fails()) {
            return response()
                        ->json([
                            'message' => $validator->errors()->all()
                        ], 400);
        }

        try {
            $is_deleted = !!WasteDay::where('key', $key)->delete();
        } catch(\Exception $e) {
            return response('', 500);
        }

        return response('', 204);
    }
}
