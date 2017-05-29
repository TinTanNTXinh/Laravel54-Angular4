<?php

namespace App\Http\Middleware;

use Closure;
use App\Role;
use App\UserRole;
use App\Common\AuthHelper;

class InvoiceGarage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $jwt_data = AuthHelper::getCurrentUser();
        if (!$jwt_data['status'])
            return redirect()->back();
        $user = $jwt_data['user'];

        $user_roles = UserRole::whereActive(true)->where('user_id', $user->id)->pluck('role_id');
        $role       = Role::whereActive(true)->where('name', 'InvoiceGarage')->first();
        if ($user_roles->contains($role->id)) {
            return $next($request);
        } else {
            error_log('Access denied');
            return redirect()->back();
        }
    }
}
