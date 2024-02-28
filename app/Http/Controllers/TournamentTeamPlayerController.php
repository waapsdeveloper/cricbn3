<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TournamentTeamPlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TournamentTeamPlayerController extends Controller
{


    public function index()
    {
        $tourteamplayers = TournamentTeamPlayer::with('tournamentTeam', 'tournamentPlayer')->get();
        return $this->success('Tournament Team and Players retrieved successfully', ['data' => $tourteamplayers]);
    }

    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'tournament_team_id' => 'required|exists:tournament_teams,id',
            'tournament_player_id' => 'required|exists:tournament_players,id'
        ]);

        // If validation fails, return failure response
        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }


        $tourteamplayers = TournamentTeamPlayer::create([
            'tournament_team_id' => $request->input('tournament_team_id'),
            'tournament_player_id' => $request->input('tournament_player_id')
        ]);

        // Return success response
        return $this->success('Tournament Team and Player created successfully', ['data' => $tourteamplayers]);
    }


    public function update(Request $request, string $id)
    {
        $tourteamplayers = TournamentTeamPlayer::find($id);

        if (!$tourteamplayers) {
            return $this->failure('Tournament Team and Player not found');
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'tournament_team_id' => 'required|exists:tournament_teams,id',
            'tournament_player_id' => 'required|exists:tournament_players,id'
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }

        $tourteamplayers->update([
            'tournament_team_id' => $data['tournament_team_id'],
            'tournament_player_id' => $data['tournament_player_id']
        ]);

        return $this->success('Tournament Team and Player updated successfully', ['data' => $tourteamplayers]);
    }


    public function destroy($id)
    {
        $tourteamplayers = TournamentTeamPlayer::find($id);

        if (!$tourteamplayers) {
            return $this->failure('Tournament Team and Player not found');
        }

        $tourteamplayers->delete();

        return $this->success('Tournament Team and Player deleted successfully', ['data' => ['id' => $id]]);
    }

}
