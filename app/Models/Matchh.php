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
        'flag1_id',
        'flag2_id',
        'team1_id',
        'team2_id',
        'title',
        'status',
        'match_type',
        'location',
        'score_board',
        'date',
    ];

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }


        public function flag1()
    {
        return $this->belongsTo(Flag::class, 'flag1_id');
    }

    public function flag2()
    {
        return $this->belongsTo(Flag::class, 'flag2_id');
    }

}
