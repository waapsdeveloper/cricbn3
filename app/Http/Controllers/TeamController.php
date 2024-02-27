<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{

    public function index()
    {
        $teams = Team::with('player')->get();
        return $this->success('Teams retrieved successfully', ['data' => $teams]);
    }


    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'player_id' => 'required|exists:player,id',
            'logo' => 'required|string',
            'location' => 'required|string',
            'established_date' => 'required|date',
            'home_venue' => 'required|string',
            'coach' => 'required|string',
        ]);

        // If validation fails, return failure response
        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }


        $teams = Team::create([
            'name' => $request->input('name'),
            'naplayer_idme' => $request->input('player_id'),
            'logo' => $request->input('logo'),
            'location' => $request->input('location'),
            'established_date' => $request->input('established_date'),
            'home_venue' => $request->input('home_venue'),
            'coach' => $request->input('coach'),
        ]);

        // Return success response
        return $this->success('Team created successfully', ['data' => $teams]);
    }


    public function update(Request $request, string $id)
    {
        $teams = Team::find($id);

        if (!$teams) {
            return $this->failure('Team not found');
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'player_id' => 'required|exists:player,id',
            'logo' => 'required|string',
            'location' => 'required|string',
            'established_date' => 'required|date',
            'home_venue' => 'required|string',
            'coach' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }

        $teams->update([
            'name' => $data['name'],
            'player_id' => $data['player_id'],
            'logo' => $data['logo'],
            'location' => $data['location'],
            'established_date' => $data['established_date'],
            'home_venue' => $data['home_venue'],
            'coach' => $data['coach'],
        ]);

        return $this->success('Team updated successfully', ['data' => $teams]);
    }



    public function destroy($id)
    {
        $teams = Team::find($id);

        if (!$teams) {
            return $this->failure('Team not found');
        }

        $teams->delete();

        return $this->success('Team deleted successfully', ['data' => ['id' => $id]]);
    }


}
