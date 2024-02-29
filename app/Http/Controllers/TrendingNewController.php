<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TrendingNew;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrendingNewController extends Controller
{

    public function index()
    {
        $news = TrendingNew::all();
        return $this->success('News retrieved successfully', ['data' => $news]);
    }



    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|string'
        ]);

        // If validation fails, return failure response
        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }


        $news = TrendingNew::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $request->input('image')
        ]);

        // Return success response
        return $this->success('News created successfully', ['data' => $news]);
    }



    public function update(Request $request, string $id)
    {
        $news = TrendingNew::find($id);

        if (!$news) {
            return $this->failure('News not found');
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors()->first());
        }

        $news->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => $data['image'],
        ]);

        return $this->success('News updated successfully', ['data' => $news]);
    }


    public function destroy($id)
    {
        $news = TrendingNew::find($id);

        if (!$news) {
            return $this->failure('News not found');
        }

        $news->delete();

        return $this->success('News deleted successfully', ['data' => ['id' => $id]]);
    }

}
