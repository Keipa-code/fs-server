<?php

declare(strict_types=1);


namespace App\Http\Service;


use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\SimpleCache\CacheInterface;
use SpazzMarticus\Tus\Factories\FilenameFactoryInterface;
use SpazzMarticus\Tus\Providers\LocationProviderInterface;
use SpazzMarticus\Tus\TusServer;

class Tus extends TusServer
{
    protected bool $allowGetCalls = true;

    public function __construct(
        ResponseFactoryInterface $responseFactory,
        StreamFactoryInterface $streamFactory,
        CacheInterface $storage,
        EventDispatcherInterface $eventDispatcher,
        FilenameFactoryInterface $targetFileFactory,
        LocationProviderInterface $locationProvider)
    {
        parent::__construct(
            $responseFactory,
            $streamFactory,
            $storage,
            $eventDispatcher,
            $targetFileFactory,
            $locationProvider);
    }


}