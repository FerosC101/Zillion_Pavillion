<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StaffAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->guard('staff')->check()) {
            return redirect()->route('staff.login')->with('error', 'Please log in to access the staff area.');
        }

        if (!auth()->guard('staff')->user()->is_active) {
            auth()->guard('staff')->logout();
            return redirect()->route('staff.login')->with('error', 'Your account has been deactivated.');
        }

        return $next($request);
    }
}
