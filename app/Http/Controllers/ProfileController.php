<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index()
    {
        $data = User::findOrFail(Auth::User()->id_user);
        return view('profile', compact('data'));
    }

    function edit_validation(Request $request)
    {
        $request->validate([
            'email'     =>  'required|email',
            'username'    =>  'required',
            'first_name'    =>  'required',
            'last_name'    =>  'required',
            'description'    =>  'required'
        ]);

        $data = $request->all();

        if(!empty($data['password']))
        {
            $form_data = array(
                'username'      =>  $data['username'],
                'first_name'      =>  $data['first_name'],
                'last_name'      =>  $data['last_name'],
                'email'     =>  $data['email'],
                'description'      =>  $data['description'],
                'password'  =>  Hash::make($data['password'])
            );
        }
        else
        {
            $form_data = array(
                'username'      =>  $data['username'],
                'first_name'      =>  $data['first_name'],
                'last_name'      =>  $data['last_name'],
                'email'     =>  $data['email'],
                'description'      =>  $data['description']
            );
        }

        User::whereId(Auth::User()->id_user)->update($form_data);

        return redirect('profile')->with('success', 'Profile Data Updated');

    }
    public function show($id)
    {
      if (!Auth::check()) return redirect('/login');
      $user = User::find($id);
      $this->authorize('show', $user);
      return view('pages.user', ['user' => $user]);
    }
    protected function validator(array $data){
        return Validator::make($data, [
          'name' => 'nullable|string|max:255',
          'email' => 'nullable|string|email|max:255|unique:users',
          'password' => 'nullable|string|confirmed|min:6'
        ]);
      }
    public function editProfile(Request $request){
        $user = Auth::user();
        // return $user;


        $validation = $this->validator($request->all());
        if($validation->fails()){
          return redirect()->back()->withErrors($validation);
        }
        else{
          if(!Auth::check()) return redirect('/login');
  
          $input = $request->all();
  
          $username = $input["username"];
          $first_name = $input["first_name"];
          $last_name = $input["last_name"];
          $email = $input["email"];
          $password = $input["password"];
  
          if(isset($username)) $user->username = $username;
          if(isset($first_name)) $user->first_name = $first_name;
          if(isset($last_name)) $user->last_name = $last_name;
          if(isset($email)) $user->email = $email;
          if(isset($password)) $user->password = bcrypt($password);
  
          if($input != NULL )$user->save();

          return redirect('user/' . $user->id);
        }
      }

    public function showEdit(){
    return view('pages.editProfile');
    }

}
