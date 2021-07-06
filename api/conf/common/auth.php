<?php

declare(strict_types=1);

use App\Upload\Entity\File;
use App\Upload\Entity\FileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

return [
    FileRepository::class => static function (ContainerInterface $container): FileRepository {
        $em = $container->get(EntityManagerInterface::class);
        $repo = $em->getRepository(File::class);
        return new FileRepository($em, $repo);
    },
];
