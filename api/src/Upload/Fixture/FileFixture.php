<?php

declare(strict_types=1);

namespace App\Upload\Fixture;

use App\Upload\Entity\File;
use App\Upload\Entity\Id;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;

class FileFixture extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {
        $file = new File(
            Id::generate(),
            new DateTimeImmutable(),
            'filename',
            '1024',
            'linkurl',
            'previewLink',
            'my comment'
        );

        $manager->persist($file);

        $manager->flush();
    }
}
