<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Permission;

class Matchh extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'team1_id',
        'team2_id',
        'title',
        'status',
        'match_type',
        'location',
        'score_board'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
