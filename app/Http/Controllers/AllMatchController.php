<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AllMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AllMatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $match = AllMatch::all();
        return self::success('Match retrieved successfully', ['data' => $match]);
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
            'teams' => 'required|string',
            'venue' => 'required|string',
            'match_type' => 'required|string',
            'status' => 'required|string',
            'weather' => 'required|string',
        ]);

        if ($validator->fails()) {
            return self::failure($validator->errors()->first());
        }

        $match = AllMatch::create($data);

        return self::success('Match created successfully', ['data' => $match]);
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
    $match = AllMatch::where('id', $id)->first();

    if (!$match) {
        return self::failure('Match not found');
    }

    $data = $request->all();

    $validator = Validator::make($request->all(), [
        'teams' => 'required|string|max:255',
        'venue' => 'string|max:255',
        'match_type' => 'string|max:255',
        'status' => 'string|max:255',
        'weather' => 'string|max:255',
    ]);

    if ($validator->fails()) {
        return self::failure($validator->errors()->first());
    }

    $obj = [
        'teams' => $data['teams'],
        'venue' => $data['venue'],
        'match_type' => $data['match_type'],
        'status' => $data['status'],
        'weather' => $data['weather'],
    ];

    $match->update($obj);

    return self::success('Match updated successfully', ['data' => $match]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Assuming your model is named Tournament
        $match = AllMatch::find($id);

        if (!$match) {
            return self::failure('Tournament not found');
        }

        $match->delete();

        return self::success('Match deleted successfully', ['data' => ['id' => $id]]);
    }






}
