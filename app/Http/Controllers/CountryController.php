<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{

    public function index()
    {
        $countries = Country::all();
        return $this->success('Countries retrieved successfully', ['data' => $countries]);
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


        $countries = Country::create([
            'name' => $request->input('name')
        ]);

        // Return success response
        return $this->success('Country created successfully', ['data' => $countries]);
    }




    public function update(Request $request, string $id)
    {
        $countries = Country::find($id);

        if (!$countries) {
            return $this->failure('Country not found');
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }

        $countries->update([
            'name' => $data['name']
        ]);

        return $this->success('Country updated successfully', ['data' => $countries]);
    }



    public function destroy($id)
    {
        $countries = Country::find($id);

        if (!$countries) {
            return $this->failure('Country not found');
        }

        $countries->delete();

        return $this->success('Country deleted successfully', ['data' => ['id' => $id]]);
    }


}
