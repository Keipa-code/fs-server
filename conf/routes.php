<?php

declare(strict_types=1);

use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->get('/', 'Application\Controller\FileController:index')->setName('home');

    $app->post('/', 'Application\Controller\FileController:uploadFile')->setName('uploaded');


};