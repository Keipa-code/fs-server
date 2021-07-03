<?php

declare(strict_types=1);

use App\Factory\Thumb;
use Laminas\ConfigAggregator\PhpFileProvider;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactory;
use SpazzMarticus\Tus\Services\FileService;
use Symfony\Component\Cache\Adapter\ApcuAdapter;
use Symfony\Component\Cache\Adapter\ChainAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Psr16Cache;

require __DIR__ . '/../vendor/autoload.php';

$test = '1';
$test1 = 1;

var_dump(json_encode($test));
var_dump(json_encode($test1));