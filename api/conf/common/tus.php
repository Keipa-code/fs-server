<?php

declare(strict_types=1);

use App\Factory\TusFilenameFactory;
use App\Http\Listener\Complete;
use App\Http\Service\Tus;
use App\Upload\Command\UploadByTUS\Handler;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\ResponseFactoryInterface;
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


return [
    /*Tus::class => static function (ContainerInterface $container, Handler $handler) {
        $uploadDirectory = __DIR__ . '/../../var/uploads/';
        $cacheDirectory = __DIR__ . '/../../var/storage/';

        $responseFactory = new ResponseFactory();
        $streamFactory = new StreamFactory();
        $logger = $container->get(\Psr\Log\LoggerInterface::class);
        $storage = new PSR16cache(new ChainAdapter([new ApcuAdapter(), new FilesystemAdapter('', 0, $cacheDirectory)]));

        $dispatcher = new EventDispatcher();
        $listener = new Complete($handler, $container->get(\Psr\Log\LoggerInterface::class));
        $dispatcher->addListener(UploadComplete::class, [$listener, 'handle']);
        $filenameFactory = new TusFilenameFactory($uploadDirectory);

        $locationProvider = new PathLocationProvider();

        $tus = new Tus($responseFactory, $streamFactory, $storage, $dispatcher, $filenameFactory, $locationProvider);
        $tus->setAllowGetCalls(true, null);
        $tus->setLogger($container->get(\Psr\Log\LoggerInterface::class));
        $tus->addCompleteListener($listener, 'handle');

        return $tus;
    },*/
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
        new TusFilenameFactory(__DIR__ . '/../../var/uploads/'),
    LocationProviderInterface::class => static fn (): LocationProviderInterface => new PathLocationProvider(),

];


/*'tus-server.upload.created' => [
    App\Http\Listener\UploadCreate::class => 'handle'
],*/