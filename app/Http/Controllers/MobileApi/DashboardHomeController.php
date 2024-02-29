<?php

namespace App\Http\Controllers\MobileApi;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Matchh;
use App\Models\Flag;
use App\Models\OngoingSeries;

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





public function ongoingseries(Request $request)
    {
        $series = OngoingSeries::all();

        return response()->json(['series' => $series]);
    }
}
