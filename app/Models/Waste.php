<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waste extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $hidden = ['pivot'];

    public function days () {
        return $this->belongsToMany(Day::class, 'waste_days')
                    ->select(['days.*', 'waste_days.collection_time_start','waste_days.collection_time_end','waste_days.key as collection_id']);
    }
}