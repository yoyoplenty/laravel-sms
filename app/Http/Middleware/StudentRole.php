<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentRole {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        $studentRole = config('global.studentRole');

        if (auth()->user()->role_id === $studentRole)  return $next($request);
        else return response()->json(['message' => 'Unauthorized', 'success' => false], 401);
    }
}
