<?php

declare(strict_types=1);

use Slim\Flash\Messages;

return [
    Messages::class => static function () {
        $storage = [];
        return new Messages($storage);
    },
];
