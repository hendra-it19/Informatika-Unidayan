<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class UserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role): Response | View
    {
        if ($request->user()->hasRole($role)) {
            return $next($request);
        }
        notify()->warning('401', 'Anda tidak memiliki otorisasi!');
        return redirect()->back();
    }
}
