<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillRequest;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function store(SkillRequest $request){
        $skill = $request->user()->skills()->create($request->only([
            "name",
            "years",
            "certification",
            "proficiency",
            "pinned",
        ]));

        return $skill;
    }

    public function update(SkillRequest $request, Skill $skill){
        $skill->update($request->only([
            "name",
            "years",
            "certification",
            "proficiency",
            "pinned",
        ]));

        return $skill;
    }

    public function destroy(Request $request, Skill $skill){
        $skill->delete();

        return response()->noContent();
    }
}
