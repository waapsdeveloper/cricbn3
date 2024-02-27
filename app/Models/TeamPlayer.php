<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Permission;

class TeamPlayer extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'team_id',
        'player_id'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }
}
