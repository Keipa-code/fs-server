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

$uuid = Uuid::fromString(str_replace(
    '/upload/',
    '',
    '/upload/9a9fad94-adbd-4183-b93b-e058d8de7b87'
));

$u1 = $uuid->getHex()->toString();

$u2 = trim('/upload/9a9fad94-adbd-4183-b93b-e058d8de7b87',  '/upload/');
//$file = new (__DIR__."/*.png");

var_dump($u1);
