<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Ramsey\Uuid\Uuid;
use TusPhp\Tus\Server as Tus;

return [
    Tus::class => static function (ContainerInterface $container) {
        $dir = __DIR__.'/../../var/uploadedFiles/'.Uuid::uuid4()->toString();
        $tus = new Tus;
        $tus->setUploadDir($dir);
        /**
         * @psalm-suppress MixedArrayAccess
         * @var array<string, array> $listeners
         */
        $listeners = $container->get('tus')['listeners'];
        foreach ($listeners as $event => $function) {
            /** @var string $name */
            foreach ($function as $class => $name) {
                $tus->event()->addListener($event, [$class, $name]);
            }
        }
        return $tus;
    },
    'tus' => [
        'listeners' => [
            'tus-server.upload.complete' => [
                App\Http\Listener\UploadComplete::class => 'handle'
            ],
        ]
    ]
];


/*'tus-server.upload.created' => [
    App\Http\Listener\UploadCreate::class => 'handle'
],*/