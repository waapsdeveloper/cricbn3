<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OngoingSeries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OngoingSeriesController extends Controller
{

    public function index()
    {
        $series = OngoingSeries::all();
        return $this->success('series retrieved successfully', ['data' => $series]);
    }



    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'abbreviation' => 'required|string',
            'logo' => 'required|string'
        ]);

        // If validation fails, return failure response
        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }


        $series = OngoingSeries::create([
            'name' => $request->input('name'),
            'abbreviation' => $request->input('abbreviation'),
            'logo' => $request->input('logo')
        ]);

        // Return success response
        return $this->success('Series created successfully', ['data' => $series]);
    }




    public function update(Request $request, string $id)
    {
        $series = OngoingSeries::find($id);

        if (!$series) {
            return $this->failure('Series not found');
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'abbreviation' => 'required|string',
            'logo' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }

        $series->update([
            'name' => $data['name'],
            'abbreviation' => $data['abbreviation'],
            'logo' => $data['logo']
        ]);

        return $this->success('Series updated successfully', ['data' => $series]);
    }



    public function destroy($id)
    {
        $series = OngoingSeries::find($id);

        if (!$series) {
            return $this->failure('Series not found');
        }

        $series->delete();

        return $this->success('Series deleted successfully', ['data' => ['id' => $id]]);
    }



}
