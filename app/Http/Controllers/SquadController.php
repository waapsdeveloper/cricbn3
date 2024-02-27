<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Squad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SquadController extends Controller
{

    public function index()
    {
        $squads = Squad::all();
        return $this->success('Squads retrieved successfully', ['data' => $squads]);
    }



    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'player_type' => 'required|string',
            'jersey_number' => 'required|integer',
            'date_of_birth' => 'required|date',
            'height' => 'required|string',
            'weight' => 'required|string',
        ]);

        // If validation fails, return failure response
        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }


        $squads = Squad::create([
            'name' => $request->input('name'),
            'player_type' => $request->input('player_type'),
            'jersey_number' => $request->input('jersey_number'),
            'date_of_birth' => $request->input('date_of_birth'),
            'height' => $request->input('height'),
            'weight' => $request->input('weight'),
        ]);

        // Return success response
        return $this->success('Squad created successfully', ['data' => $squads]);
    }



    public function update(Request $request, string $id)
    {
        $squads = Squad::find($id);

        if (!$squads) {
            return $this->failure('Squad not found');
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'player_type' => 'required|string',
            'jersey_number' => 'required|integer',
            'date_of_birth' => 'required|date',
            'height' => 'required|string',
            'weight' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }

        $squads->update([
            'name' => $data['name'],
            'player_type' => $data['player_type'],
            'jersey_number' => $data['jersey_number'],
            'date_of_birth' => $data['date_of_birth'],
            'height' => $data['height'],
            'weight' => $data['weight'],
        ]);

        return $this->success('Squad updated successfully', ['data' => $squads]);
    }



    public function destroy($id)
    {
        $squads = Squad::find($id);

        if (!$squads) {
            return $this->failure('Squad not found');
        }

        $squads->delete();

        return $this->success('Squad deleted successfully', ['data' => ['id' => $id]]);
    }




}
