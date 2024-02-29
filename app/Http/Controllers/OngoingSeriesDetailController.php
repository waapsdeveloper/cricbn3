<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OngoingSeriesDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OngoingSeriesDetailController extends Controller
{


    Public function index()
    {
        $seriesdetail = OngoingSeriesDetail::with('ongoingseries')->get();
        return $this->success('Series Detail retrieved successfully', ['data' => $seriesdetail]);
    }




    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [

            'ongoing_series_id' => 'required|exists:ongoing_series,id',
            'venue' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'match_type' => 'required|string',
            'overs' => 'required|string'
        ]);

        // If validation fails, return failure response
        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }


        $seriesdetail = OngoingSeriesDetail::create([
            'ongoing_series_id' => $request->input('ongoing_series_id'),
            'venue' => $request->input('venue'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'match_type' => $request->input('match_type'),
            'overs' => $request->input('overs')
        ]);

        // Return success response
        return $this->success('Series Detail created successfully', ['data' => $seriesdetail]);
    }



    public function update(Request $request, string $id)
    {
        $seriesdetail = OngoingSeriesDetail::find($id);

        if (!$seriesdetail) {
            return $this->failure('Series Detail not found');
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'ongoing_series_id' => 'required|exists:ongoing_series,id',
            'venue' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'match_type' => 'required|string',
            'overs' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }

        $seriesdetail->update([

            'ongoing_series_id' => $data['ongoing_series_id'],
            'venue' => $data['venue'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'match_type' => $data['match_type'],
            'overs' => $data['overs'],
        ]);

        return $this->success('Series Detail updated successfully', ['data' => $seriesdetail]);
    }


    public function destroy($id)
    {
        $seriesdetail = OngoingSeriesDetail::find($id);

        if (!$seriesdetail) {
            return $this->failure('Series Detail not found');
        }

        $seriesdetail->delete();

        return $this->success('Series Detail deleted successfully', ['data' => ['id' => $id]]);
    }
}
