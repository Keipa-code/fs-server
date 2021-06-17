<?php

declare(strict_types=1);

use App\Http\Action;
use Slim\App;
use SpazzMarticus\Tus\TusServer as Tus;

return static function (App $app): void {
    $app->get('/', Action\HomeAction::class);
    $app->any('/upload', Tus::class);
};
