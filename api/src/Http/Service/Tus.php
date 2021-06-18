<?php

declare(strict_types=1);


namespace App\Http\Service;


use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\SimpleCache\CacheInterface;
use SpazzMarticus\Tus\Events\UploadComplete;
use SpazzMarticus\Tus\Factories\FilenameFactoryInterface;
use SpazzMarticus\Tus\Providers\LocationProviderInterface;
use SpazzMarticus\Tus\TusServer;
use Symfony\Component\EventDispatcher\EventDispatcher;

class Tus extends TusServer
{

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

    public function addCompleteListener($listener, $funcName) {
        /** @var EventDispatcher $ed */
        $ed = $this->eventDispatcher;
        $ed->addListener(UploadComplete::class, [$listener, $funcName]);
    }
}