<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Routing\Route;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Session\Middleware\StartSession as BaseStartSession;

class StartSession extends BaseStartSession
{
    /**
     * Add the session cookie to the application response.
     *
     * Overridden to guard against null responses returned by controllers/handlers.
     *
     * @param  \Symfony\Component\HttpFoundation\Response|null  $response
     * @param  \Illuminate\Contracts\Session\Session  $session
     * @return void
     */
    protected function addCookieToResponse($response, Session $session)
    {
        // If response is null, create an empty response so we can attach cookies
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

        // Call parent implementation logic by duplicating behavior (can't call parent::addCookieToResponse because it's protected in parent and signature same)
        if ($this->sessionIsPersistent($config = $this->manager->getSessionConfig())) {
            $response->headers->setCookie(new Cookie(
                $session->getName(), $session->getId(), $this->getCookieExpirationDate(),
                $config['path'], $config['domain'], $config['secure'] ?? false,
                $config['http_only'] ?? true, false, $config['same_site'] ?? null
            ));
        }
    }
}
