<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    use HasRoles;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::auth();
        $role = User::role('admin');
        if ($user instanceof User && $role) {
            $message = 'Your account has been suspended for '.Carbon::now()->diffInHours(Auth::user()->banned_at).'h . Please contact administrator.';
            Auth::logout();

            return redirect()->route('login')->with('message', $message);
        }
        return $next($request);
    }
}
