<?php

declare(strict_types=1);

use Doctrine\Common\Cache\Psr6\DoctrineProvider;
use Doctrine\Common\EventManager;
use Doctrine\Common\EventSubscriber;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\Tools\Setup;
use Psr\Container\ContainerInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

return [
    EntityManagerInterface::class => static function (ContainerInterface $container) {
        /**
         * @psalm-suppress MixedArrayAccess
         * @psalm-var array{
         *     entity_path:array,
         *     dev_mode:bool,
         *     proxy_dir:string,
         *     cache:?string,
         *     event_subscribers:string[],
         *     connection:array<string, mixed>,
         *     types:array<string,class-string<Doctrine\DBAL\Types\Type>>
         * } $settings
         */
        $settings = $container->get('doctrine');

        $config = Setup::createAnnotationMetadataConfiguration(
            $settings['entity_path'],
            $settings['dev_mode'],
            $settings['proxy_dir'],
            $settings['cache'] ?
                DoctrineProvider::wrap(new FilesystemAdapter('', 0, $settings['cache'])) :
                DoctrineProvider::wrap(new ArrayAdapter()),
            false
        );

        $config->setNamingStrategy(new UnderscoreNamingStrategy());

        foreach ($settings['types'] as $name => $class) {
            if (!Type::hasType($name)) {
                Type::addType($name, $class);
            }
        }

        //$config->setDefaultQueryHint(Query::HINT_CUSTOM_OUTPUT_WALKER,'\App\Data\Doctrine\IlikeWalker');
        $eventManager = new EventManager();

        foreach ($settings['event_subscribers'] as $name) {
            /** @var EventSubscriber $eventSubscriber */
            $eventSubscriber = $container->get($name);
            $eventManager->addEventSubscriber($eventSubscriber);
        }

        return EntityManager::create($settings['connection'], $config, $eventManager);
    },
    'doctrine' => [
        'entity_path' => [
            __DIR__ . '/../../src/Upload/Entity',
        ],
        'dev_mode' => false,
        'proxy_dir' => __DIR__ . '/../../var/cache/proxies',
        'cache' => __DIR__ . '/../../var/cache/cache',
        'event_subscribers' => [],
        'connection' => [
            'driver' => 'pdo_pgsql',
            'host' => getenv('DB_HOST'),
            'dbname' => getenv('DB_NAME'),
            'port' => '5432',
            'user' => getenv('DB_USER'),
            'password' => getenv('DB_PASSWORD'),
            'charset' => 'utf-8',
        ],
        'types' => [
            App\Upload\Entity\IdType::NAME => App\Upload\Entity\IdType::class,
        ],
    ],
];
