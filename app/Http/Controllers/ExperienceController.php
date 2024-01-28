<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExperienceStoreRequest;
use App\Models\Experience;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{

    public function index(Request $request){
        return Experience::where('user_id', $request->user()->id)->get();
    }

    public function store(ExperienceStoreRequest $request){
        $experience = Experience::create([
            ...$request->all(),
            'start_date' => Carbon::parse($request->start_date),
            'end_date' => $request->end_date ? null : Carbon::parse($request->end_date),
            'user_id' => $request->user()->id]);

        return $experience;
    }
}
