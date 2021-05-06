<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;

return static function (ContainerInterface $container): App {
    $app = AppFactory::createFromContainer($container);
    (require __DIR__ . '/../conf/middleware.php')($app);
    (require __DIR__ . '/../conf/routes.php')($app);
    return $app;
};
