<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    protected function validation(int $id_user)
    {
        return  [
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'email' => ['required', 'string', 'email','min:10', 'max:255', Rule::unique('users')->ignore(User::find($id_user))],
            'username' => ['required', 'string', 'min:5','max:255', Rule::unique('users')->ignore(User::find($id_user))]
        ];
    }

    
    public function showAdminUsers()
    {
      if (!Auth::check()) return redirect('/login');
      else if(!Auth::user()->is_admin) return redirect ('/');
      //echo "oi";
      $user = Auth::user();
      //echo $user;
      $users = User::get();
      //echo $users;
      return view('pages.showUsers', ['user' => $user, 'users' => $users]);
    }

    public function show($id)
    {
      if (!Auth::check()) return redirect('/login');
      $user = User::find($id);
      $this->authorize('show', $user);
      return view('pages.user', ['user' => $user]);
    }

    public function showUserProfile(int $id_user)
    {
        Gate::authorize('show' ,User::find($id_user));
        if (!(Auth::user()->is_admin)) {
            return redirect('/profile/'. $id_user.'/view');
        } else if (Auth::id() !== $id_user) {
            return redirect('/admin/profile/'.$id_user);
        }
        
        $user = self::getUserById($id_user);

        return view('pages.editProfile', ['user' => $user]);
    }

    public function showViewUserProfile(int $id_user)
    {
        Gate::authorize('show' ,User::find($id_user));
        if (!(Auth::user()->is_admin)) {
            $notifications = NotificationsController::getNotifications(Auth::id());
            $user = self::getUserById($id_user);
            return view('pages.profileView', ['user' => $user, 'notifications' => $notifications]);
        }else{
            return redirect('/admin/profile/'.$id_user);
        }
    }

    public function updateUserById(int $id_user, Request $req)
    {
        Gate::authorize('update-user',User::find($id_user));
        $req->validate($this->validation($id_user));

        $user = User::find($id_user);
        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->username = $req->username;
        $user->email = $req->email;
        $user->save();
        
        return redirect()->back();
    }

}