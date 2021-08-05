<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteDay extends Model
{
    use HasFactory;

    protected $fillable = ['waste_id', 'day_id', 'collection_time_start', 'collection_time_end'];
}
