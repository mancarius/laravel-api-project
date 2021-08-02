<?php

namespace App\Http\Controllers;

use App\Models\Day;

class DayController extends Controller
{
    /**
     * Show the collected wastes in the given day.
     *
     * @param int $id If no day id is given, will be shown all days.
     * @return \App\Models\Day
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
            return [ 'days' => Day::with('wastes')->get() ];
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return [ 'days' => [] ];
        }
    }


    /**
     * Return the collected wastes in the given day.
     *
     * @param int $id
     * @return \App\Models\Day
     */
    private function showOne($id)
    {
        if($id > 0) {
            try{
                return [ 'wastes' => Day::findOrFail($id)->wastes ];
            } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                return [ 'wastes' => [] ];
            }
        }
        else
        {
            return [ 'wastes' => [] ];
        }
    }
}
