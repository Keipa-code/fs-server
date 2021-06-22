<?php

declare(strict_types=1);

use App\Factory\TusFilenameFactory;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\SimpleCache\CacheInterface;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Factory\StreamFactory;
use SpazzMarticus\Tus\Events\UploadComplete;
use SpazzMarticus\Tus\Factories\FilenameFactoryInterface;
use SpazzMarticus\Tus\Providers\LocationProviderInterface;
use SpazzMarticus\Tus\Providers\PathLocationProvider;
use Symfony\Component\Cache\Adapter\ApcuAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Psr16Cache;
use Symfony\Component\Cache\Adapter\ChainAdapter;
use Symfony\Component\EventDispatcher\EventDispatcher;
use App\Upload\Command;


return [
    StreamFactoryInterface::class => static fn (): StreamFactoryInterface => new StreamFactory(),
    CacheInterface::class =>
        static fn (): CacheInterface =>
        new PSR16cache(
            new ChainAdapter([
                new ApcuAdapter(),
                new FilesystemAdapter('', 0, __DIR__ . '/../../var/storage/')
            ])),
    EventDispatcherInterface::class => static fn (): EventDispatcherInterface => new EventDispatcher(),
    FilenameFactoryInterface::class =>
        static fn (): FilenameFactoryInterface =>
        new TusFilenameFactory(__DIR__ . '/../../var/upload/'),
    LocationProviderInterface::class => static fn (): LocationProviderInterface => new PathLocationProvider(),

];


/*'tus-server.upload.created' => [
    App\Http\Listener\UploadCreate::class => 'handle'
],*/