<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{


    public function index()
    {
        $contacts = ContactUs::all();
        return $this->success('Contact US retrieved successfully', ['data' => $contacts]);
    }


    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string',
            'message' => 'required|string'
        ]);

        // If validation fails, return failure response
        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }


        $contacts = ContactUs::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message')
        ]);

        // Return success response
        return $this->success('Contact Us created successfully', ['data' => $contacts]);
    }


    public function update(Request $request, string $id)
    {
        $contacts = ContactUs::find($id);

        if (!$contacts) {
            return $this->failure('Contact Us not found');
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|string',
            'message' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }

        $contacts->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'message' => $data['message'],
        ]);

        return $this->success('Contact Us updated successfully', ['data' => $contacts]);
    }



    public function destroy($id)
    {
        $contacts = ContactUs::find($id);

        if (!$contacts) {
            return $this->failure('Contact US not found');
        }

        $contacts->delete();

        return $this->success('Contact Us deleted successfully', ['data' => ['id' => $id]]);
    }

}
