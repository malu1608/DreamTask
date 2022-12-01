<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    protected function validation(int $id_user)
    {
        return  [
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(User::find($id_user))],
            'username' => ['required', 'string', 'min:4', Rule::unique('users')->ignore(User::find($id_user))]
        ];
    }
}