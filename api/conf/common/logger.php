<?php

declare(strict_types=1);

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return [
    LoggerInterface::class => static function (ContainerInterface $container) {
        /**
         * @var string[] $loggerSettings
         */
        $loggerSettings = $container->get('logger');

        $level = $loggerSettings['debug'] ? Logger::DEBUG : Logger::INFO;

        $logger = new Logger($loggerSettings['name']);

        $example_timezone = 'Asia/Oral';
        //hack to force timezone to get set in logger the way we want it
        date_default_timezone_set($example_timezone);
        if ($loggerSettings['stderr']) {
            $logger->pushHandler(new StreamHandler('php://stderr', $level));
        }

        if (!empty($loggerSettings['file'])) {
            $logger->pushHandler(new StreamHandler($loggerSettings['file'], $level));
        }

        $processor = new UidProcessor();
        $logger->pushProcessor($processor);

        return $logger;
    },
    'logger' => [
        'debug' => (bool)getenv('APP_DEBUG'),
        'stderr' => true,
        'name' => 'slim-app',
        'file' => null,
        'level' => (getenv('APPLICATION_ENV') !== 'production') ? Logger::DEBUG : Logger::INFO,
    ],
];
