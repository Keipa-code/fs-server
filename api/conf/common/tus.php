<?php

declare(strict_types=1);

use App\Factory\TusFilenameFactory;
use App\Http\Listener\Complete;
use App\Upload\Command\UploadByTUS\Handler;
use Psr\Container\ContainerInterface;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Factory\StreamFactory;
use SpazzMarticus\Tus\Events\UploadComplete;
use SpazzMarticus\Tus\Providers\PathLocationProvider;
use SpazzMarticus\Tus\TusServer as Tus;
use Symfony\Component\Cache\Adapter\ApcuAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Psr16Cache;
use Symfony\Component\Cache\Adapter\ChainAdapter;
use Symfony\Component\EventDispatcher\EventDispatcher;

return [
    Tus::class => static function (ContainerInterface $container, Handler $handler) {
        $uploadDirectory = __DIR__ . '/../../var/uploads/';
        $cacheDirectory = __DIR__ . '/../../var/storage/';

        $responseFactory = new ResponseFactory();
        $streamFactory = new StreamFactory();

        $storage = new PSR16cache(new ChainAdapter([new ApcuAdapter(), new FilesystemAdapter('', 0, $cacheDirectory)]));

        $dispatcher = new EventDispatcher();
        $listener = new Complete($handler);
        $dispatcher->addListener(UploadComplete::class, [$listener, 'handle']);

        $filenameFactory = new TusFilenameFactory($uploadDirectory);

        $locationProvider = new PathLocationProvider();

        $tus = new Tus($responseFactory, $streamFactory, $storage, $dispatcher, $filenameFactory, $locationProvider);
        $tus->setAllowGetCalls(true, null);

        $tus->setLogger($container->get(\Psr\Log\LoggerInterface::class));

        return $tus;
    },
];


/*'tus-server.upload.created' => [
    App\Http\Listener\UploadCreate::class => 'handle'
],*/