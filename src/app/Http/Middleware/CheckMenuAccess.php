<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class CheckMenuAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $menuId
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $menuId)
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Check if the user is authenticated and has a role
        if ($user && $user->role_id) {
            // Retrieve the user's role
            $role = Role::find($user->role_id);

            // Check if the role exists and has associated menus
            if ($role && $role->menus->contains($menuId)) {
                // User has access to the menu ID
                return $next($request);
            }
        }

        // User does not have access to the menu ID; handle unauthorized access
        return abort(403, 'Unauthorized');
    }
}
