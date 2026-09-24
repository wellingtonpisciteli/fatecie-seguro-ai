<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ModalidadeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(
        Request $request,
        Closure $next,
        string $modalidade
    ): Response {
        if ($request->user()->modalidade !== $modalidade) {
            abort(403);
        }

        return $next($request);
    }
}