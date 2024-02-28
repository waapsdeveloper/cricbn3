<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MatchDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatchDetailController extends Controller
{

    Public function index()
    {
        $matchdetails = MatchDetail::with('matchh','team1', 'team2')->get();
        return $this->success('Match Detail retrieved successfully', ['data' => $matchdetails]);
    }


    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'match_id' => 'required|exists:matchhs,id',
            'date_time' => 'required|date',
            'toss' => 'required|string',
            'stadium' => 'required|string',
            'country' => 'required|string',
            'province' => 'required|string'
        ]);

        // If validation fails, return failure response
        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }


        $matchdetails = MatchDetail::create([
            'match_id' => $request->input('match_id'),
            'date_time' => $request->input('date_time'),
            'toss' => $request->input('toss'),
            'stadium' => $request->input('stadium'),
            'country' => $request->input('country'),
            'province' => $request->input('province')
        ]);

        // Return success response
        return $this->success('Match Detail created successfully', ['data' => $matchdetails]);
    }


    public function update(Request $request, string $id)
    {
        $matchdetails = MatchDetail::find($id);

        if (!$matchdetails) {
            return $this->failure('Match Detail not found');
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'match_id' => 'required|exists:matchh,id',
            'date_time' => 'required|date',
            'toss' => 'required|string',
            'stadium' => 'required|string',
            'country' => 'required|string',
            'province' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }

        $matchdetails->update([
            'match_id' => $data['match_id'],
            'date_time' => $data['date_time'],
            'toss' => $data['toss'],
            'stadium' => $data['stadium'],
            'country' => $data['country'],
            'province' => $data['province'],
        ]);

        return $this->success('Match Detail updated successfully', ['data' => $matchdetails]);
    }


    public function destroy($id)
    {
        $matchdetails = MatchDetail::find($id);

        if (!$matchdetails) {
            return $this->failure('Match Detail not found');
        }

        $matchdetails->delete();

        return $this->success('Match Detail deleted successfully', ['data' => ['id' => $id]]);
    }
}
