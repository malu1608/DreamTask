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
}