<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Permission;

class Tournament extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tournament_organizer_id',
        'name',
        'abbreviation',
        'prize',
        'start_date',
        'end_date'
    ];
    public function organizers()
    {
        return $this->hasMany(TournamentOrganizer::class);
    }

    // public function player()
    // {
    //     return $this->belongsTo(Player::class, 'player_id');
    // }

}
