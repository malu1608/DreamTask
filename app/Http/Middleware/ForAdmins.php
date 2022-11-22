<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForAdminns
{
    /**
     * For handleing incoming requests as Admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handleForAdmins(Request $request, Closure $next)
    {
        if ($request->user() == null || (Amin::where('id_admin', '=', $request->user()->id_user)->count() == 0)) {
            return redirect('/');
        }
        return $next($request);
    }
}