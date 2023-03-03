<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $capability = null)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        if ($user->is_super_admin) {
            return $next($request); // if user is super admin, they can access all pages
        }
        $user->load('role');
        $role = $user->role;
        $permission = $role->permissions()->first();
        if (!$role || !$permission) {
            abort(403, 'Unauthorized');
        }
        if (is_null($capability) || in_array($capability, $permission->capabilities)) {
            return $next($request);
        }
        abort(403, 'Unauthorized');
    }

}
