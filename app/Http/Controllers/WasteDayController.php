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
            'day' => 'bail|required|exists:App\Models\Day,id',
            'waste' => 'bail|required|exists:App\Models\Waste,id',
            'time_start' => 'bail|required|date_format:G:i:s',
            'time_end' => 'bail|required|date_format:G:i:s|after:time_start'
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
                            'message' => ["This collection already exist in this day."]
                        ], 400);
        }

        $is_slot_available = DayController::isSlotAvailableInDay($request->day, $request->time_start, $request->time_end);

        if (!$is_slot_available)
        {
            return response()
                        ->json([
                            'message' => ["This collection overlaps with another one."]
                        ], 400);
        }

        // create collection
        $waste_days = new WasteDay([
            'key' => bin2hex(random_bytes(20)),
            'waste_id' => $request->waste,
            'day_id' => $request->day,
            'collection_time_start' => $request->time_start,
            'collection_time_end' => $request->time_end
        ]);

        $waste_days->save();

        $waste_days->refresh();

        $json_response = json_encode([
            'collection' => [
                'id' => $waste_days->key
            ]
        ]);

        return response()->json($json_response, 201);
    }


    public function update(Request $request, $key)
    {
        $collection = $request->all();
        $collection['key'] = $key;

        $validator = Validator::make($collection, [
            'key' => 'bail|required|exists:App\Models\WasteDay,key',
            'time_start' => 'bail|required|date_format:G:i:s',
            'time_end' => 'bail|required|date_format:G:i:s|after:time_start'
        ]);

        if ($validator->fails()) {
            return response()
                        ->json([
                            'message' => $validator->errors()->all()
                        ], 400);
        }

        $waste_days = WasteDay::where('key', $collection['id'])->first();

        $is_slot_available = DayController::isSlotAvailableInDay($waste_days->day_id, $collection['time_start'], $collection['time_end']);

        if (!$is_slot_available)
        {
            return response()
                        ->json([
                            'message' => ["This collection overlaps with another one."]
                        ], 400);
        }

        // update collection
        try {

            $waste_days->collection_time_start = $collection['time_start'];

            $waste_days->collection_time_end = $collection['time_end'];

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
