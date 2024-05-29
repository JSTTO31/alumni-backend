<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactInformationRequest;
use App\Models\ContactInformation;
use Illuminate\Http\Request;

class ContactInformationController extends Controller
{
    public function store(ContactInformationRequest $request){
        $contact_information = $request->user()->contact_information()->create($request->only([
            'mobile_number',
            'home_number',
            'work_number',
            'address',
            'region',
            'city',
            'postal_code',
            'facebook',
            'twitter',
            'linkedin'
        ]));

        return $contact_information;
    }

    public function update(ContactInformationRequest $request, ContactInformation $contact_information){
        $contact_information->update($request->only([ 'mobile_number',
            'home_number',
            'work_number',
            'address',
            'region',
            'city',
            'postal_code',
            'facebook',
            'twitter',
            'linkedin'
        ]));

        return $contact_information;
    }
}
