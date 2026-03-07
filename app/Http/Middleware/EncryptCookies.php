<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cookie\Middleware\EncryptCookies as BaseEncryptCookies;
use Symfony\Component\HttpFoundation\Response;

class EncryptCookies extends BaseEncryptCookies
{
    /**
     * Handle an incoming request.
     *
     * Overridden to guard against null responses from handlers.
     *
     * @param  \Symfony\Component\HttpFoundation\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next)
    {
        $response = $next($this->decrypt($request));

        if (is_null($response)) {
            $response = response('', 200);
        }

        // Ensure we have a proper Response instance
        if (! $response instanceof Response) {
            try {
                $response = Response::create($response);
            } catch (\Throwable $e) {
                $response = response('', 200);
            }
        }

        return $this->encrypt($response);
    }
}

