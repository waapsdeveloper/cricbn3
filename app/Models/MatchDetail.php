<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Permission;

class MatchDetail extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'match_id',
        'date_time',
        'toss',
        'stadium',
        'country',
        'province'
    ];

    public function matchh()
    {
        return $this->belongsTo(Matchh::class, 'match_id');
    }

}
