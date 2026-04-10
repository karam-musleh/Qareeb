<?php

namespace App\Http\Middleware;

use App\Enum\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OwnerHubMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || !$user->role->value!== UserRole::HUB_OWNER->value || !$user->hubs()->exists() ||!$user->role->value!== UserRole::ADMIN->value) {
            return response()->json(['message' => 'you should be the owner of this hub'], 401);
        }

        return $next($request);
    }
}
