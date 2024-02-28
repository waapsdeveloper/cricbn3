<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TournamentPlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TournamentPlayerController extends Controller
{

    public function index()
    {
        $tourplayer = TournamentPlayer::with('country')->get();
        return $this->success('Tournament Players retrieved successfully', ['data' => $tourplayer]);
    }


    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'country_id' => 'required|exists:countries,id',
            'jersey_number' => 'required|integer'
        ]);

        // If validation fails, return failure response
        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }


        $tourplayer = TournamentPlayer::create([
            'name' => $request->input('name'),
            'country_id' => $request->input('country_id'),
            'jersey_number' => $request->input('jersey_number')
        ]);

        // Return success response
        return $this->success('Tournament Player created successfully', ['data' => $tourplayer]);
    }



    public function update(Request $request, string $id)
    {
        $tourplayer = TournamentPlayer::find($id);

        if (!$tourplayer) {
            return $this->failure('Tournament Player not found');
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'country_id' => 'required|exists:countries,id',
            'jersey_number' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }

        $tourplayer->update([
            'name' => $data['name'],
            'country_id' => $data['country_id'],
            'jersey_number' => $data['jersey_number']
        ]);

        return $this->success('Tournament Player updated successfully', ['data' => $tourplayer]);
    }


    public function destroy($id)
    {
        $tourplayer = TournamentPlayer::find($id);

        if (!$tourplayer) {
            return $this->failure('Tournament Player not found');
        }

        $tourplayer->delete();

        return $this->success('Tournament Player deleted successfully', ['data' => ['id' => $id]]);
    }


}
