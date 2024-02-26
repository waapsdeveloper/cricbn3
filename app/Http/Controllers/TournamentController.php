<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tournament = Tournament::all();
        return self::success('tournaments retrieved successfully', ['data' => $tournament]);
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
            'name' => 'required|unique:tournaments,name|string|max:255',
            'location' => 'required|string',
            'organizer' => 'required|string',
            'team' => 'required|string',
            'schedule' => 'required|date',
            'prize' => 'required|string',
            'status' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return self::failure($validator->errors()->first());
        }

        $tournament = Tournament::create($data);
        return self::success('Tournament created successfully', ['data' => $tournament]);
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
        $tournament = Tournament::where('id', $id)->first();

        if (!$tournament) {
            return self::failure('Tournament not found');
        }

        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'location' => 'string|max:255',
            'organizer' => 'string|max:255',
            'team' => 'integer',
            'schedule' => 'string',
            'prize' => 'string|max:255',
            'status' => 'string|max:255',
            'start_date' => 'date',
            'end_date' => 'date',
        ]);

        if ($validator->fails()) {
            return self::failure($validator->errors()->first());
        }

        $obj = [
            'name' => $data['name'],
            'location' => $data['location'],
            'organizer' => $data['organizer'],
            'team' => $data['team'],
            'schedule' => $data['schedule'],
            'prize' => $data['prize'],
            'status' => $data['status'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ];

        $tournament->update($obj);

        return self::success('Tournament updated successfully', ['data' => $tournament]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Assuming your model is named Tournament
        $tournament = Tournament::find($id);

        if (!$tournament) {
            return self::failure('Tournament not found');
        }

        $tournament->delete();

        return self::success('Tournament deleted successfully', ['data' => ['id' => $id]]);
    }





   
}
