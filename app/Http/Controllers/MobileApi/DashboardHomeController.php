<?php

namespace App\Http\Controllers\MobileApi;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Matchh;
use App\Models\Flag;
use App\Models\OngoingSeries;
use App\Models\OngoingSeriesDetail;
use App\Models\TrendingNew;
use App\Models\AboutUs;

class DashboardHomeController extends Controller
{
    public function matches(Request $request)
    {
        $matches = Matchh::with(['team1', 'team2', 'flag1', 'flag2'])->get();

        return response()->json(['match' => $matches]);
    }


    public function upcommingmatches(Request $request)
{
    $currentDate = Carbon::now()->toDateString();

    $matches = Matchh::with('team1', 'team2', 'flag1','flag2')
        ->whereDate('date', '>', $currentDate)
        ->get();

    return response()->json(['match' => $matches]);
}



public function recentmatches(Request $request)
{
    $currentDate = Carbon::now()->toDateString();

    // Subtracting 1 month from the current date
    $oneMonthAgo = Carbon::now()->subMonth()->toDateString();

    $matches = Matchh::with('team1', 'team2', 'flag1', 'flag2', 'player')
        ->whereDate('date', '>', $oneMonthAgo) // Matches from previous month
        ->whereDate('date', '<', $currentDate) // Matches before today
        ->get();

    return response()->json(['match' => $matches]);
}






public function ongoingseries(Request $request)
    {
        $series = OngoingSeries::all();

        return response()->json(['series' => $series]);
    }



    Public function ongoingseriesdetail()
    {
        $seriesdetail = OngoingSeriesDetail::with('ongoingseries')->get();
        return $this->success('Series Detail retrieved successfully', ['data' => $seriesdetail]);
    }



    public function trendingnew()
    {
        $news = TrendingNew::all();
        return $this->success('News retrieved successfully', ['data' => $news]);
    }


    public function aboutus()
    {
        $about = AboutUs::all();
        return $this->success('about us retrieved successfully', ['data' => $about]);
    }
}
