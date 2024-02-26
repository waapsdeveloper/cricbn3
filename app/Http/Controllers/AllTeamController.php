<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AllTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AllTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $team = AllTeam::all();
        return self::success('Match retrieved successfully', ['data' => $team]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'abbreviation' => 'required|string',
            'logo' => 'required|string',
            'location' => 'required|string',
            'established_date' => 'required|date',
            'home_venue' => 'required|string',
            'coach' => 'required|string',
        ]);

        if ($validator->fails()) {
            return self::failure($validator->errors()->first());
        }

        $team = AllTeam::create($data);

        return self::success('Match created successfully', ['data' => $team]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $team = AllTeam::where('id', $id)->first();

    if (!$team) {
        return self::failure('Team not found');
    }

    $data = $request->all();

    $validator = Validator::make($request->all(), [
        'name' => 'required|string',
        'abbreviation' => 'required|string',
        'logo' => 'required|string',
        'location' => 'required|string',
        'established_date' => 'required|date',
        'home_venue' => 'required|string',
        'coach' => 'required|string',
    ]);

    if ($validator->fails()) {
        return self::failure($validator->errors()->first());
    }

    $obj = [
        'name' => $data['name'],
        'abbreviation' => $data['abbreviation'],
        'logo' => $data['logo'],
        'location' => $data['location'],
        'established_date' => $data['established_date'],
        'home_venue' => $data['home_venue'],
        'coach' => $data['coach'],
    ];

    $team->update($obj);

    return self::success('Match updated successfully', ['data' => $team]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Assuming your model is named Tournament
        $team = AllTeam::find($id);

        if (!$team) {
            return self::failure('Tournament not found');
        }

        $team->delete();

        return self::success('Match deleted successfully', ['data' => ['id' => $id]]);
    }






}
