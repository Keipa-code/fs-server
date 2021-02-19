<?php

declare(strict_types=1);

use DI\Container;
use Monolog\Logger;

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
            ]
       ];
    });
    $container->set('upload_directory', __DIR__ . '/../uploads');
};