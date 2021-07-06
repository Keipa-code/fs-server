<?php

declare(strict_types=1);

namespace App\Upload\Test\Unit\File\File;

use App\Upload\Entity\File;
use App\Upload\Entity\Id;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * @internal
 */
final class UploadByTus extends TestCase
{
    public function testSuccess(): void
    {
        $file = new File(
            $id = Id::generate(),
            $date = new DateTimeImmutable(),
            $filename = 'video.mp4',
            $filesize = '398398',
            $fileLink = Uuid::uuid4()->toString(),
            $previewLink = null,
            $authorComment = 'long comment'
        );

        self::assertEquals($id, $file->getId());
        self::assertEquals($date, $file->getDate());
        self::assertEquals($filename, $file->getFilename());
        self::assertEquals($filesize, $file->getFilesize());
        self::assertEquals($fileLink, $file->getFileLink());
        self::assertEquals($previewLink, $file->getPreviewLink());
        self::assertEquals($authorComment, $file->getAuthorComment());
    }
}
