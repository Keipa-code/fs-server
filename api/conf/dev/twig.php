<?php

declare(strict_types=1);

return [
    'views' => [
        'template_path' => __DIR__ . '/../../tmpl/',
        'twig' => [
            'cache' => __DIR__ . '/../../var/cache/' . PHP_SAPI . '/doctrine/proxies',
            'auto_reload' => true,
        ],
    ],
];
