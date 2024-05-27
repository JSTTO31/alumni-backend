<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonalInformationRequest;
use App\Models\PersonalInformation;
use App\Models\User;
use Illuminate\Http\Request;

class PersonalInformationController extends Controller
{
    public function store(PersonalInformationRequest $request){

        $personal_information = $request->user()->personal_information()->create([
            "first_name" =>  $request->first_name,
            "middle_name" => $request->middle_name, 
            "last_name" =>  $request->last_name,
            "nationality" => $request->nationality,
            "gender" =>  $request->gender,
            "age" =>  $request->age,
            "civil_status" =>  $request->civil_status,
            "birthday" =>  $request->birthday,
        ]);


        return $personal_information;
    }

    public function update(PersonalInformationRequest $request, PersonalInformation $personal_information){
        $personal_information->first_name =  $request->first_name;
        $personal_information->middle_name = $request->middle_name; 
        $personal_information->last_name =  $request->last_name;
        $personal_information->nationality = $request->nationality;
        $personal_information->gender =  $request->gender;
        $personal_information->age =  $request->age;
        $personal_information->civil_status =  $request->civil_status;
        $personal_information->birthday =  $request->birthday;
        $personal_information->save();

        return $personal_information;
    }
}
