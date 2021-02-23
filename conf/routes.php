<?php

declare(strict_types=1);

use Slim\App;

return function (App $app) {
    $app->get('/', 'App\Controller\FileController:index')->setName('home');

    $app->post('/', 'App\Controller\FileController:uploadFile')->setName('uploaded');
};