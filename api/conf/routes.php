<?php

declare(strict_types=1);

use App\Http\Action;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return static function (App $app): void {
    $app->get('/', Action\HomeAction::class);
    $app->group('/upload/', function (RouteCollectorProxy $group) {
        $group->map(['POST', 'DELETE', 'PATCH', 'PUT', 'OPTIONS'], '[{id}]', Action\AddFiles\RequestAction::class);
        $group->get('[{id}]', Action\DownloadFile\RequestAction::class);
    });
    //$app->any('/upload/[{id}]', Action\AddFiles\RequestAction::class);

    $app->get('/thumbs/{id}', Action\GetThumbnail\RequestAction::class);
};
