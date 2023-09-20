<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckKeyword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validKeywords = [
            'created_at',
            'updated_at',
            'most_watch_today',
            'most_watch_week',
            'most_watch_month',
        ];

        $keyword = $request->route('keyword');
        // dd($keyword);
        if (!in_array($keyword, $validKeywords)) {
            abort(404);
        }
        return $next($request);
    }
}
