<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TournamentTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TournamentTeamController extends Controller
{

    public function index()
    {
        $tourteam = TournamentTeam::all();
        return $this->success('Tournament Teams retrieved successfully', ['data' => $tourteam]);
    }


    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'logo' => 'required|string',
            'established_date' => 'required|date',
            'coach' => 'required|string',
        ]);

        // If validation fails, return failure response
        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }


        $tourteam = TournamentTeam::create([
            'name' => $request->input('name'),
            'logo' => $request->input('logo'),
            'established_date' => $request->input('established_date'),
            'coach' => $request->input('coach'),
        ]);

        // Return success response
        return $this->success('Tournament Team created successfully', ['data' => $tourteam]);
    }


    public function update(Request $request, string $id)
    {
        $tourteam = TournamentTeam::find($id);

        if (!$tourteam) {
            return $this->failure('Tournament Team not found');
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'logo' => 'required|string',
            'established_date' => 'required|date',
            'coach' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }

        $tourteam->update([
            'name' => $data['name'],
            'logo' => $data['logo'],
            'established_date' => $data['established_date'],
            'coach' => $data['coach'],
        ]);

        return $this->success('Tournament Team updated successfully', ['data' => $tourteam]);
    }



    public function destroy($id)
    {
        $tourteam = TournamentTeam::find($id);

        if (!$tourteam) {
            return $this->failure('Tournament Team not found');
        }

        $tourteam->delete();

        return $this->success('Tournament Team deleted successfully', ['data' => ['id' => $id]]);
    }


}
