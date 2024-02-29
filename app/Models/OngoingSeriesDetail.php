<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Permission;

class OngoingSeriesDetail extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'ongoing_series_id',
        'venue',
        'start_date',
        'end_date',
        'match_type',
        'overs'
    ];

    public function ongoingseries()
    {
        return $this->belongsTo(ongoingseries::class, 'ongoing_series_id');
    }


}
