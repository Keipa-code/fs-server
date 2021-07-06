<?php

declare(strict_types=1);

namespace Test\Functional;

use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Factory\UploadedFileFactory;

/**
 * @internal
 */
final class TusTest extends WebTestCase
{
    public function testUploadSuccess(): void
    {
        $realFile = (new UploadedFileFactory())->createUploadedFile(
            (new StreamFactory())->createStream(''),
            70,
            UPLOAD_ERR_OK,
        );

        $response = $this->app()->handle(self::jsonWithFile('POST', '/upload', $realFile));

        self::assertEquals(201, $response->getStatusCode());
    }
}
