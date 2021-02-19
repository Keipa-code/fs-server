<?php

declare(strict_types=1);

use DI\Container;
use Slim\Factory\AppFactory;
use Psr\Http\Message\UploadedFileInterface;

require_once __DIR__ . '/../vendor/autoload.php';

$container = new Container;

$settings = require __DIR__. '/../app/settings.php';
$settings($container);

$logger = require __DIR__. '/../app/logger.php';
$logger($container);



// Set Container on App
AppFactory::setContainer($container);



// Create App
$app = AppFactory::create();

$views = require __DIR__. '/../app/views.php';
$views($app);

$middleware = require __DIR__. '/../app/middleware.php';
$middleware($app);

$routes = require __DIR__ . '/../app/routes.php';
$routes($app);




function moveUploadedFile(string $directory, UploadedFileInterface $uploadedFile)
{
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);

    // see http://php.net/manual/en/function.random-bytes.php
    $basename = bin2hex(random_bytes(8));
    $filename = sprintf('%s.%0.8s', $basename, $extension);

    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

    return $filename;
}

$app->run();


//require_once __DIR__ . ('/../src/Views/index.html');