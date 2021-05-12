<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;

require __DIR__ . '/../vendor/autoload.php';

/** @var ContainerInterface $container */
$container = require __DIR__ . '/../conf/container.php';

$app = (require __DIR__ . '/../conf/app.php')($container);
$app->run();
