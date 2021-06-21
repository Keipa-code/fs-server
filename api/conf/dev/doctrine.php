<?php

declare(strict_types=1);

return [
    'doctrine' => [
        'dev_mode' => true,
        'proxy_dir' => __DIR__ . '/../../var/cache/' . PHP_SAPI . '/doctrine/proxies',
        'cache' => null,
        'event_subscribers' => [
            //\App\Data\Doctrine\FixDefaultSchemaSubscriber::class,
        ],
    ],
];
