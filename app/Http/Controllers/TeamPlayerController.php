<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TeamPlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamPlayerController extends Controller
{

    public function index()
{
    $teamplayers = TeamPlayer::with('team', 'player')->get();
    return $this->success('Team and Players retrieved successfully', ['data' => $teamplayers]);
}



    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'team_id' => 'required|exists:teams,id',
            'player_id' => 'required|exists:players,id'
        ]);

        // If validation fails, return failure response
        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }


        $teamplayers = TeamPlayer::create([
            'team_id' => $request->input('team_id'),
            'player_id' => $request->input('player_id')
        ]);

        // Return success response
        return $this->success('Team and Player created successfully', ['data' => $teamplayers]);
    }


    public function update(Request $request, string $id)
    {
        $teamplayers = TeamPlayer::find($id);

        if (!$teamplayers) {
            return $this->failure('Team and Player not found');
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'team_id' => 'required|exists:teams,id',
            'player_id' => 'required|exists:players,id'
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }

        $teamplayers->update([
            'team_id' => $data['team_id'],
            'player_id' => $data['player_id']
        ]);

        return $this->success('Team and Player updated successfully', ['data' => $teamplayers]);
    }


    public function destroy($id)
    {
        $teamplayers = TeamPlayer::find($id);

        if (!$teamplayers) {
            return $this->failure('Team and Player not found');
        }

        $teamplayers->delete();

        return $this->success('Team and Player deleted successfully', ['data' => ['id' => $id]]);
    }
}
