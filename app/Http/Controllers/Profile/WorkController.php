<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkRequest;
use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function store(WorkRequest $request){
        $work = $request->user()->work()->create($request->only([
            'company_name',
            'company_website',
            'position_title',
            'position_level',
            'industry',
            'specialization',
            'description',
            'current',
            'from',
            'to',
        ]));

        return $work;
    }

    public function update(WorkRequest $request, Work $work){
        $work->update($request->only([
            'company_name',
            'company_website',
            'position_title',
            'position_level',
            'industry',
            'specialization',
            'description',
            'current',
            'from',
            'to',
        ]));

        return $work;
    }

    public function destroy(Request $request, Work $work){
        $work->delete();

        return response()->noContent();
    }
}
