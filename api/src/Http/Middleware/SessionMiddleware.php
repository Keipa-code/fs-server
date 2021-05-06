<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Flash\Messages;
use Symfony\Component\HttpFoundation\Session\Session;

final class SessionMiddleware implements MiddlewareInterface
{
    private Session $session;
    private Messages $flash;

    public function __construct(
        Session $session,
        Messages $flash
    ) {
        $this->session = $session;
        $this->flash = $flash;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->session->start();
        $this->flash->__construct($_SESSION);
        return $handler->handle($request);
    }
}
