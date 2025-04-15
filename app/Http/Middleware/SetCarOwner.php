<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\CarOwner;
use Symfony\Component\HttpFoundation\Response;

class SetCarOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $slug = $request->route('car_owner');

        $carOwner = CarOwner::where('slug', $slug)->firstOrFail();

        app()->instance('currentTenant', $carOwner);
        
        return $next($request);
    }
}
