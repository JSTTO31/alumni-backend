<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\EducationRequest;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function store(EducationRequest $request){
        $education = $request->user()->educations()->create($request->only([
            "attainment",
            "school",
            "field",
            "major",
            "graduated_at",
        ]));

        return $education;
    }

    public function update(EducationRequest $request, Education $education){
        $education->update($request->only([
            "attainment",
            "school",
            "field",
            "major",
            "graduated_at",
        ]));

        return $education;
    }

    public function destroy(Request $request, Education $education){
        $education->delete();

        return response()->noContent();
    }
}
