<?php

namespace App\Http\Controllers;

use App\Models\Waste;
use Exception;
use Illuminate\Http\Request;

class WasteController extends Controller
{
    /**
     * Show the collect days for the given waste.
     *
     * @param int $id If no waste id is given, will be shown all wastes.
     * @return App\Models\Waste
     */
    public function show($id = false)
    {
        if($id === false)
            return $this->showAll();
        else
            return $this->showOne($id);
    }


    /**
     * Return the collected wastes for every day.
     *
     * @return \App\Models\Day
     */
    private function showAll()
    {
        try{
            return [ 'wastes' => Waste::with('days')->get() ];
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return [ 'wastes' => [] ];
        }
    }


    /**
     * Return the collect days for the given waste.
     *
     * @param int $id
     * @return \App\Models\Day
     */
    private function showOne($id)
    {
        try{
            return ['days' => Waste::findOrFail($id)->days ];
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ['days' => [] ];
        }
    }

}
