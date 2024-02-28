<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Permission;

class TournamentTeamPlayer extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tournament_team_id',
        'tournament_player_id'
    ];

    public function tournamentTeam()
    {
        return $this->belongsTo(TournamentTeam::class, 'team_id');
    }

    public function tournamentPlayer()
    {
        return $this->belongsTo(tournamentPlayer::class, 'player_id');
    }
}
