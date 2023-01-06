<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

use App\Models\TeamMember;

use Validator;

class TeamMemberController extends Controller 
{
    public function showTeams() {
        return 'WIP';
    }


    public function removeMember(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'id_user' => ['required','integer'],
            'id_team' => ['required','integer'],
        ]);

        if ($validator->fails()) {
            return redirect()->back();
        }

        $team_id = $request['id_team'];
        $user_id = $request['id_user'];

        if (Auth::user()->is_admin || Auth::user()->isCoordinator($team_id)) {
            TeamMember::where('id_user', '=', $user_id)
                        ->where('id_team', '=', $team_id)
                        ->delete();
        return redirect()->back();
        } else return redirect()->back();
    }


}