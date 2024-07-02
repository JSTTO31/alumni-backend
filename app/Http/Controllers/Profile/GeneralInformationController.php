<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralInformationRequest;
use Illuminate\Http\Request;

class GeneralInformationController extends Controller
{
    public function store(GeneralInformationRequest $request){
        $general_information = $request->user()->general_information()->updateOrCreate($request->only([
            'department_id',
            'branch_id',
            'student_number',
            'graduation_year',
        ]));

        $request->user()->verified_at = now();
        $request->user()->save();

        return $general_information;
    }

    public function update(GeneralInformationRequest $request){
        $request->user()->general_information()->update($request->only([
            'department',
            'school_branches',
            'student_number',
            'graduation_year',
        ]));



        return $request->user()->general_information;
    }
}
