<?php

declare(strict_types=1);

namespace App\Upload\Fixture;

use App\Upload\Entity\File;
use App\Upload\Entity\Id;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;

final class FileFixture extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {
        $file = new File(
            Id::generate(),
            new DateTimeImmutable(),
            'filename',
            json_encode(['size' => '1024', 'format' => 'linkurl']),
            'Link',
            'previeLink'
        );

        $manager->persist($file);

        $manager->flush();
    }
}
