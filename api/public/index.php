<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$container = require __DIR__ . '/../conf/container.php';

$app = (require __DIR__ . '/../conf/app.php')($container);
$app->run();
