<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Logger;

define('APP_ROOT', __DIR__);

return function (ContainerBuilder $containerBuilder) {
    $rootPath = realpath(__DIR__ . '/..');
    $containerBuilder->addDefinitions([
        'settings' => [
            'base_path' => '',
            'debug' => (getenv('APPLICATION_ENV') != 'production'),
            'route_cache' => $rootPath . '/var/cache/routes',
            'displayErrorDetails' => true,
            'logErrorDetails' => true,
            'logErrors' => true,
            'upload_directory' => __DIR__ . '/../uploads',
            'logger' => [
                'name' => 'slim-app',
                'path' => getenv('docker') ? 'php://stdout' : $rootPath . '/var/log/app.log',
                'level' => (getenv('APPLICATION_ENV') != 'production') ? Logger::DEBUG : Logger::INFO,
            ],
            'views' => [
                'template_path' => $rootPath . '/tmpl',
                'twig' => [
                    'cache' => false,
                    'auto_reload' => true,
                ],
            ],
            'doctrine' => [
                'meta' => [
                    'entity_path' => [$rootPath . '/src/Entity'],
                    'auto_generate_proxies' => true,
                    'proxy_dir' => $rootPath . '/var/cache/proxies',
                    'cache' => null,
                ],
                /*// if true, metadata caching is forcefully disabled
                'dev_mode' => true,

                // path where the compiled metadata info will be cached
                // make sure the path exists and it is writable
                'cache_dir' => APP_ROOT . '/../var/cache/doctrine',

                // you should add any other path containing annotated entity classes
                'metadata_dirs' => [APP_ROOT . '/src/Entity'],
                */
                'connection' => [
                    'driver' => 'pdo_pgsql',
                    'host' => 'postgres',
                    'dbname' => 'test',
                    'user' => 'admin',
                    'password' => '123456',
                    'charset' => 'utf-8'
                ]
            ]
        ]
    ]);
    // $container->set('upload_directory', __DIR__ . '/../uploads');
};