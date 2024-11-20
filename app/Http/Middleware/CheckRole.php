<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role = Role::find($request->user()->role_id);
        if($role){
            switch ($role->name) {
                case "admin":
                    $request->request->add([
                        'scope' => 'do-anything'
                    ]);
                    return $next($request);
                
            }
        }
        return $next($request);
    }
}
