<?php

namespace App\Http\Middleware;

use Closure;

class ProcessSymbols
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $txt = str_replace(';', '', $request->get("text"));
        echo $request->get('text')."<br>";
        echo $txt."<br>";
        return $next($request);
    }
}
