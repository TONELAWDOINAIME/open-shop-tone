<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //  20210428 : exploitation de la méthode user() pour vérifier si l'utilisateur est un Admin. 
        if (! Auth::user()->isAdmin()) {
            //  erreur 401 : Unauthorized
            return abort(401); 
        }
        return $next($request);
    }
}
