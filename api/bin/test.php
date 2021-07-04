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

$file = __DIR__.'../var/thumbs/6a7361de-39c5-4c8a-999d-d10684ee106a.jpg';

$file1 = imageCreateFromJpeg($file);