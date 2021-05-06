<?php

declare(strict_types=1);

namespace App\Http\Action;

use App\Http\JsonResponse;
use Psr\Http\Server\RequestHandlerInterface;
use stdClass;

final class HomeAction implements RequestHandlerInterface
{
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        return new JsonResponse(new stdClass());
    }
}
