<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InformationController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'informations' => ['required', 'array'],
            'informations.*.label' => ['required', 'string'],
            'informations.*.content' => ['required', 'string'],
            'informations.*.type' => ['required', 'string']]);

        $data = collect($request->informations)->map(fn($item) => [...$item, 'user_id' => $request->user()->id])[0];

        $information = DB::table('information')->insert($data);


        return $information;
    }
}
