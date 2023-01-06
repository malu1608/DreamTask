<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

use App\Models\TeamMember;
use App\Models\Team;

use Validator;

class TeamMemberController extends Controller 
{
    public function showTeams() {
        return 'WIP';
    }

    protected function validation()
    {
        return  [
            'name' => 'required|string|max:64',
            'field' => 'required|string|max:64',
        ];
    }

    public function create($id, Request $request) {
        $id_user = Auth::user()->id_user;
        $validator = $request->validate($this->validation());

        $team = new Team;

        $team->name = $request->name;
        $team->field = $request->field;
        $team->id_project = $id;

        $team->save();

        $coordinator = new TeamMember;
        
        $coordinator->id_user = $id_user;
        $coordinator->id_team = $team->id_team;
        $coordinator->is_coordinator = True;

        $coordinator->save();

        return redirect("/project/" . $id );
    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'id_team' => ['required','integer'],
        ]);

        if ($validator->fails()) {
            return redirect()->back();
        }

        $team_id = $request['id_team'];

        if (Auth::user()->is_admin || Auth::user()->isCoordinator($team_id)) {

            Team::where('id_team', '=', $team_id)->delete();

            TeamMember::where('id_team', '=', $team_id)
                        ->delete();

            return redirect()->back();
        } else return redirect()->back();
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

    public function addMember(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'username' => ['required','string', 'exists:users,username'],
            'id_team' => ['required','integer'],
        ]);

        if ($validator->fails()) {
            return redirect()->back();
        }

        $team_id = $request['id_team'];
        $username = $request['username'];
        $coordinator = false;

        if (isset($request['coordinator'])) $coordinator = false;

        if (Auth::user()->is_admin || Auth::user()->isCoordinator($team_id)) {
            $user = User::where('username', '=', $username)->first();

            $membership = new TeamMember;

            $membership->id_team = $team_id;
            $membership->id_user = $user->id_user;
            $membership->is_coordinator = $coordinator;
            
            $membership->save();
        return redirect()->back();
        } else return redirect()->back();
    }


}