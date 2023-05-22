<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminValidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->roles->where('name', 'Админ')->isNotEmpty()) {
            return $next($request);
        }
        return response()->json([
            'success' => true,
            'response' => [
                'message' => 'Недостаточно прав'
            ],
        ]);
    }
}
