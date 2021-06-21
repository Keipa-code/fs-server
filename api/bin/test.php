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

//$image = new Thumb(__DIR__ . '/123.png');
//$image->thumb(300,200);
//$image->save(__DIR__.'/123.jpg' => 60);

$uuid = Uuid::fromString('e2b3db3613fb4825b4e245dee17462c4');

//$file = new (__DIR__."/*.png");

var_dump($uuid->toString());