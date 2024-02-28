<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TournamentOrganizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TournamentOrganizerController extends Controller
{

    public function index()
    {
        $tourorganizer = TournamentOrganizer::with('tournament', 'organizer')->get();
        return $this->success('Tournament Organizers retrieved successfully', ['data' => $tourorganizer]);
    }


    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'tournament_id' => 'required|exists:tournaments,id',
            'organizer_id' => 'required|exists:organizers,id'
        ]);

        // If validation fails, return failure response
        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }


        $tourorganizer = TournamentOrganizer::create([
            'tournament_id' => $request->input('tournament_id'),
            'organizer_id' => $request->input('organizer_id')
        ]);

        // Return success response
        return $this->success('Tournament Organizer created successfully', ['data' => $tourorganizer]);
    }


    public function update(Request $request, string $id)
    {
        $tourorganizer = TournamentOrganizer::find($id);

        if (!$tourorganizer) {
            return $this->failure('Tournament Organizer not found');
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'tournament_id' => 'required|exists:tournaments,id',
            'organizer_id' => 'required|exists:organizers,id'
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }

        $tourorganizer->update([
            'tournament_id' => $data['tournament_id'],
            'organizer_id' => $data['organizer_id']
        ]);

        return $this->success('Tournament Organizer updated successfully', ['data' => $tourorganizer]);
    }



    public function destroy($id)
    {
        $tourorganizer = TournamentOrganizer::find($id);

        if (!$tourorganizer) {
            return $this->failure('Tournament Organizer not found');
        }

        $tourorganizer->delete();

        return $this->success('Tournament Organizer deleted successfully', ['data' => ['id' => $id]]);
    }

}
