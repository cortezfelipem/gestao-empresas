<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Symfony\Component\HttpFoundation\Cookie;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    /**
     * Add the CSRF token to the response cookies.
     *
     * Overridden to guard against $response being null in some handlers.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Symfony\Component\HttpFoundation\Response|null  $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function addCookieToResponse($request, $response)
    {
        $config = config('session');

        if ($response instanceof Responsable) {
            $response = $response->toResponse($request);
        }

        if (is_null($response)) {
            // Some controllers/middleware may return null; create an empty response
            $response = response('', 200);
        }

        // Ensure response has headers before setting cookie
        if (isset($response->headers) || method_exists($response, 'headers')) {
            $response->headers->setCookie(
                new Cookie(
                    'XSRF-TOKEN', $request->session()->token(), $this->availableAt(60 * $config['lifetime']),
                    $config['path'], $config['domain'], $config['secure'], false, false, $config['same_site'] ?? null
                )
            );
        }

        return $response;
    }
}
