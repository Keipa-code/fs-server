<?php

declare(strict_types=1);

use App\Http\Action;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use App\Router\StaticRouteGroup as Group;

return static function (App $app): void {
    $app->get('/', Action\HomeAction::class);
    $app->group('/upload/', new Group(function (RouteCollectorProxy $group): void {
        $group->map(['POST', 'DELETE', 'PATCH', 'PUT', 'OPTIONS'], '[{id}]', Action\AddFiles\RequestAction::class);
        $group->get('[{id}]', Action\DownloadFile\RequestAction::class);
    }));
    $app->get('/find', Action\FindFiles\RequestAction::class);

    $app->post('/getrowcount', Action\GetTotalRowCount\RequestAction::class);

    $app->get('/thumbs/{id}', Action\GetThumbnail\RequestAction::class);
};
