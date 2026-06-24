<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectToDefaultPortal
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('/')) {
            return new RedirectResponse(route('portal.business'));
        }

        return $next($request);
    }
}
