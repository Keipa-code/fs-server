<?php

declare(strict_types=1);

use App\Http\Action\HomeAction;
use Slim\App;
use TusPhp\Tus\Server as Tus;

return static function (App $app): void {
    $app->get('/', HomeAction::class);
    $app->any('/upload', Tus::class);
};
