<?php

declare(strict_types=1);

$containerBuilder = new DI\ContainerBuilder();

$containerBuilder->addDefinitions(__DIR__ . '/dependencies.php');
// Build PHP-DI Container instance
return $containerBuilder->build();
