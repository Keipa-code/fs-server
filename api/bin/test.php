<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Ramsey\Uuid\Uuid;

$realpath = realpath(__DIR__);

$dir = $realpath . Uuid::uuid4()->toString();

var_dump($dir);
