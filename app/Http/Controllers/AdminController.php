<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class AdminController extends Controller
{

    /**
     * Display the specified resource for users
     *
     * @return Response
     */
    public function showUsers()
    {
        
    }

    /**
     * Delete user by his id
     *
     * @return Response
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if (Amin::where('id_admin', '=', $request->user()->id_user)->count() > 0) {
            return redirect()->back()->withErrors("You can't delete an admin account.");
        }
        $user->delete();
        return redirect('/admin/manageUsers');
    }

    /**
     * Edit user by his id
     *
     * @return Response
     */

    public function edit(int $id, Request $request)
    {
        Gate::authorize('edit',User::findOrFail($id));

        $request->validate($this->validation());
        $user = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->description = $request->description;
        $user->save();

        return redirect()->back();
    }

    protected function validation()
    {
        return [
            'first_name' => 'required|string|max:64',
            'last_name' => 'required|string|max:64',
            'username' => 'required|unique:users|string|min:4|max:32',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:4|max:32',
        ];
    }

}