<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];

    public function wastes () {
        return $this->belongsToMany(Waste::class, 'waste_days')
                    ->select(['wastes.*', 'waste_days.pick_up_time_start', 'waste_days.pick_up_time_end','waste_days.key as pick_up_id']);
    }
}
