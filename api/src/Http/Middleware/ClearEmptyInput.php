<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class ClearEmptyInput implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $request = $request
            ->withParsedBody(self::filterStrings($request->getParsedBody()));

        return $handler->handle($request);
    }

    /**
     * @param array|object|null $items
     * @return array|object|null
     */
    private static function filterStrings($items)
    {
        if (!\is_array($items)) {
            return $items;
        }

        $result = [];

        /**
         * @var string $key
         * @var object|string|null $item
         */
        foreach ($items as $key => $item) {
            if (\is_string($item)) {
                $result[$key] = trim($item);
            } else {
                $result[$key] = self::filterStrings($item);
            }
        }

        return $result;
    }
}
