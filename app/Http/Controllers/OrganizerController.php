<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrganizerController extends Controller
{

    public function index()
    {
        $organizers = Organizer::all();
        return $this->success('Organizers retrieved successfully', ['data' => $organizers]);
    }



    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string'
        ]);

        // If validation fails, return failure response
        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }


        $organizers = Organizer::create([
            'name' => $request->input('name')
        ]);

        // Return success response
        return $this->success('Organizer created successfully', ['data' => $organizers]);
    }



    public function update(Request $request, string $id)
    {
        $organizers = Organizer::find($id);

        if (!$organizers) {
            return $this->failure('Organizer not found');
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }

        $organizers->update([
            'name' => $data['name']
        ]);

        return $this->success('Organizer updated successfully', ['data' => $organizers]);
    }


    public function destroy($id)
    {
        $organizers = Organizer::find($id);

        if (!$organizers) {
            return $this->failure('Organizer not found');
        }

        $organizers->delete();

        return $this->success('Organizer deleted successfully', ['data' => ['id' => $id]]);
    }

}
