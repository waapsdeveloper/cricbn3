<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Matchh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatchhController extends Controller
{
    Public function index()
{
    $matches = Matchh::with(['team1', 'team2', 'flag1', 'flag2'])->get();
    return $this->success('Matches retrieved successfully', ['data' => $matches]);
}



    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'team1_id' => 'required|exists:teams,id',
            'team2_id' => 'required|exists:teams,id',
            'title' => 'required|string',
            'status' => 'required|string',
            'match_type' => 'required|string',
            'location' => 'required|string',
            'score_board' => 'required|string'
        ]);

        // If validation fails, return failure response
        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }


        $matches = Matchh::create([
            'team1_id' => $request->input('team1_id'),
            'team2_id' => $request->input('team2_id'),
            'title' => $request->input('title'),
            'status' => $request->input('status'),
            'match_type' => $request->input('match_type'),
            'location' => $request->input('location'),
            'score_board' => $request->input('score_board'),
        ]);

        // Return success response
        return $this->success('Matches created successfully', ['data' => $matches]);
    }


    public function update(Request $request, string $id)
    {
        $matches = Matchh::find($id);

        if (!$matches) {
            return $this->failure('Match not found');
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'team1_id' => 'required|exists:teams,id',
            'team2_id' => 'required|exists:teams,id',
            'title' => 'required|string',
            'status' => 'required|string',
            'match_type' => 'required|string',
            'location' => 'required|string',
            'score_board' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }

        $matches->update([
            'team1_id' => $data['team1_id'],
            'team2_id' => $data['team2_id'],
            'title' => $data['title'],
            'status' => $data['status'],
            'match_type' => $data['match_type'],
            'location' => $data['location'],
            'score_board' => $data['score_board']
        ]);

        return $this->success('Team and Player updated successfully', ['data' => $matches]);
    }


    public function destroy($id)
    {
        $matches = Matchh::find($id);

        if (!$matches) {
            return $this->failure('Match not found');
        }

        $matches->delete();

        return $this->success('Match deleted successfully', ['data' => ['id' => $id]]);
    }



}
