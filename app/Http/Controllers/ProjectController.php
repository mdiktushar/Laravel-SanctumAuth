<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //

    public function createProject (Request $request) {
        $inputs = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'duration' => 'required',
        ]);

        auth()->user()->projects()->create($inputs);

        return response()->json([
            'status' => 200,
            'message' => 'Project Created',
        ], 200);
    }

    public function listProject () {
       
    }

    public function singleProject ($id) {

    }

    public function deleteProject ($id) {

    }
}
