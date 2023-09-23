<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserActivated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
//        app()->setLocale('ar');
//        if( isset($request->lang) && $request->lang == 'en'){
//            app()->setLocale('en');
//        }
        return Auth::user()->activated ? $next($request):\response()->json('Your account need to activated : ' . app()->currentLocale() ,'200');
    }
}
