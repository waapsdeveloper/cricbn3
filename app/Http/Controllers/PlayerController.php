<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlayerController extends Controller
{

    public function index()
    {
        $players = Player::with('country')->get();
        return $this->success('Players retrieved successfully', ['data' => $players]);
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


        $players = Player::create([
            'name' => $request->input('name'),
            'country_id' => $request->input('country_id'),
            'jersey_number' => $request->input('jersey_number')
        ]);

        // Return success response
        return $this->success('Player created successfully', ['data' => $players]);
    }


    public function update(Request $request, string $id)
    {
        $players = Player::find($id);

        if (!$players) {
            return $this->failure('Player not found');
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

        $players->update([
            'name' => $data['name'],
            'country_id' => $data['country_id'],
            'jersey_number' => $data['jersey_number']
        ]);

        return $this->success('Player updated successfully', ['data' => $players]);
    }


    public function destroy($id)
    {
        $players = Player::find($id);

        if (!$players) {
            return $this->failure('Player not found');
        }

        $players->delete();

        return $this->success('Player deleted successfully', ['data' => ['id' => $id]]);
    }



}
