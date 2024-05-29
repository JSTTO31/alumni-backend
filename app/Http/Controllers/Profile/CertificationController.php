<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\CertificationRequest;
use App\Models\Certification;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    public function store(CertificationRequest $request){
        $certification = $request->user()->certifications()->create($request->only([
            "name",
            "issuing_organization",
            "issue_date",
        ]));


        return $certification;
    }


    public function update(CertificationRequest $request, Certification $certification){
        $certification->update($request->only([
            "name",
            "issuing_organization",
            "issue_date",
        ]));


        return $certification;
    }

    public function destroy(Request $request, Certification $certification){
        $certification->delete();

        return response()->noContent();
    }
}
