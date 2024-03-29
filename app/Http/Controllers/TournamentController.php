<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TournamentController extends Controller
{

    public function index()
    {
        $tours = Tournament::all();
        return $this->success('Tournaments retrieved successfully', ['data' => $tours]);
    }



    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'abbreviation' => 'required|string',
            'prize' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date'

        ]);

        // If validation fails, return failure response
        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }


        $tours = Tournament::create([
            'name' => $request->input('name'),
            'abbreviation' => $request->input('abbreviation'),
            'prize' => $request->input('prize'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);

        // Return success response
        return $this->success('Tournament created successfully', ['data' => $tours]);
    }


    public function update(Request $request, string $id)
    {
        $tours = Tournament::find($id);

        if (!$tours) {
            return $this->failure('Tournament not found');
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'abbreviation' => 'required|string',
            'prize' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }

        $tours->update([
            'name' => $data['name'],
            'abbreviation' => $data['abbreviation'],
            'prize' => $data['prize'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);

        return $this->success('Tournament updated successfully', ['data' => $tours]);
    }



    public function destroy($id)
    {
        $tours = Tournament::find($id);

        if (!$tours) {
            return $this->failure('Tournament not found');
        }

        $tours->delete();

        return $this->success('Tournament deleted successfully', ['data' => ['id' => $id]]);
    }

}
