<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\App;
use Slim\Flash\Messages;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;

return [
    /*ResponseFactoryInterface::class => function (ContainerInterface $container) {
        return $container->get(App::class)->getResponseFactory();
    },*/

    Session::class => static function (ContainerInterface $container) {
        /**
         * @psalm-suppress MixedArrayAccess
         * @var array{
         *     name:string,
         *     cache_expire:int
         * } $settings
         */
        $settings = $container->get('settings')['session'];
        if (PHP_SAPI === 'cli') {
            return new Session(new MockArraySessionStorage());
        }
        return new Session(new NativeSessionStorage($settings));
    },

    SessionInterface::class => static fn (ContainerInterface $container) => $container->get(Session::class),

    /*'flash' => function (ContainerInterface $container) {
        $session = $container->get('session');
        return new Messages($session);
    },*/

    'settings' => [
        'session' => [
            'name' => 'webapp',
            'cache_expire' => 0,
        ],
    ],
];
