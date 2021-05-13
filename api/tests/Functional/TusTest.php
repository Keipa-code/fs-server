<?php

declare(strict_types=1);


namespace Test\Functional;


use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Factory\UploadedFileFactory;

class TusTest extends WebTestCase
{
    public function testUploadSuccess()
    {
        $realFile = (new UploadedFileFactory())->createUploadedFile(
            (new StreamFactory())->createStream(''),
            0,
            UPLOAD_ERR_OK,
        );

        $response = $this->app()->handle(self::jsonWithFile('POST', '/upload', $realFile));

        self::assertEquals(201, $response->getStatusCode());
    }
}