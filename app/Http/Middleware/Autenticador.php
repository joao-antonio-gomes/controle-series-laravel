<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Autenticador
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $estaLogado = Auth::check();
        if (!$estaLogado) {
            return redirect('/entrar');
        }

        return $next($request);
    }
}
