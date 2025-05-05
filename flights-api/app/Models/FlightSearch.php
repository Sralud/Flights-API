<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightSearch extends Model
{
    protected $table = 'flight_searches';

    protected $fillable = [
        'origin', 'destination', 'departure_date', 'return_date', 'adults'
    ];
}