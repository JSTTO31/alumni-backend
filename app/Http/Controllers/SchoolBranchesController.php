<?php

namespace App\Http\Controllers;

use App\Models\SchoolBranch;
use Illuminate\Http\Request;

class SchoolBranchesController extends Controller
{
    public function index(){
        return SchoolBranch::all();
    }
}
