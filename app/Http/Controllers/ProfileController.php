<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;

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

}
