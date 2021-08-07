<?php

namespace App\Http\Controllers;

use App\Models\Waste;
use Illuminate\Support\Facades\Validator;

class WasteController extends Controller
{
    /**
     * Return the collected wastes for every day.
     *
     * @return \App\Models\Day
     */
    public function index()
    {
        try{
            return [ 'wastes' => Waste::with('days')->get() ];
        } catch(\Exception $e) {
            return response('', 500);
        }
    }


    /**
     * Return the collect days for the given waste.
     *
     * @param int $id
     * @return \App\Models\Day
     */
    public function show($waste)
    {
        $validator = Validator::make(['waste' => $waste], [
            'waste' => 'exists:App\Models\Waste,name'
        ]);

        if ($validator->fails()) {
            return response()
                        ->json([
                            'message' => $validator->errors()->all()
                        ], 400);
        }

        try{
            return response()->json([
                'days' => Waste::where('name', $waste)->first()->days
            ]);
        } catch(\Exception $e) {
            return response('', 500);
        }
    }

}
