<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdmin {
    /**
     * Check incominh request has super admin permissions.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        if (!Auth::check() || intval(Auth::user()->{'id'}) !== intval(env('APP_MAIN_ADMIN_ID', 0))) {
            return abort(404);
        }

        return $next($request);
    }
}
