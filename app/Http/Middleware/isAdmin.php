<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        if(!$user->hasRole('admin'))
        {
            return redirect()->route('welcome')->with('danger', 'Only admins can access to the dashoard.');
        }
        return $next($request);
    }
}
