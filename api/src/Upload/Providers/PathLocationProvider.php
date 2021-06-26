<?php

declare(strict_types=1);


namespace App\Upload\Providers;


use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use SpazzMarticus\Tus\Providers\AbstractLocationProvider;
use SpazzMarticus\Tus\Providers\LocationProviderInterface;

class PathLocationProvider extends AbstractLocationProvider implements LocationProviderInterface
{

    public function provideLocation(UuidInterface $uuid, ServerRequestInterface $request): UriInterface
    {
        $uri = $request->getUri();
        $path = 'api' . rtrim($uri->getPath(), '/');
        return $uri->withHost(getenv('FRONTEND_HOST'))->withPath($path . '/' . $uuid->toString());
    }

    public function provideUuid(ServerRequestInterface $request): UuidInterface
    {
        $path = $request->getUri()->getPath();
        $parts = explode('/', $path);

        try {
            return Uuid::fromString($parts[array_key_last($parts)]);
        } catch (InvalidUuidStringException $exception) {
            throw $this->getInvalidUuidException();
        }
    }
}
