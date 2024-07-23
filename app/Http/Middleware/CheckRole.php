<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        if($role == 'not-premium' && $user->hasRole('premium')) {
            abort(404);
        } elseif ($role == 'not-premium' && !$user->hasRole('premium')) {
            return $next($request);
        }

        if (!$user->hasRole($role)) {
            abort(404);
        }

        return $next($request);
    }
}