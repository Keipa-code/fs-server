<?php

declare(strict_types=1);

use DI\Container;
use Monolog\Logger;

define('APP_ROOT', __DIR__);

return function (Container $container) {
    $container->set('settings', function() {
        return [
            'displayErrorDetails' => true,
            'logErrorDetails' => true,
            'logErrors' => true,
            'logger' => [
                'name' => 'slim-app',
                'path' => __DIR__ . '/../logs/app.log',
                'level' => Logger::DEBUG,
            ],
            'views' => [
                'path' => __DIR__ . '/../src/Views',
                'settings' => ['cache' => false],
            ],
            'doctrine' => [
                // if true, metadata caching is forcefully disabled
                'dev_mode' => true,

                // path where the compiled metadata info will be cached
                // make sure the path exists and it is writable
                'cache_dir' => APP_ROOT . '/cache/doctrine',

                // you should add any other path containing annotated entity classes
                'metadata_dirs' => [APP_ROOT . '/src/Model'],

                'connection' => [
                    'driver' => 'pdo_mysql',
                    'host' => 'localhost',
                    'port' => 3306,
                    'dbname' => 'mydb',
                    'user' => 'user',
                    'password' => 'secret',
                    'charset' => 'utf-8'
                ]
            ]
       ];
    });
    $container->set('upload_directory', __DIR__ . '/../uploads');
};