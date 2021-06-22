<?php

declare(strict_types=1);


namespace Test\Functional;


class GetThumbnail extends WebTestCase
{
    public function testCreateThumbsSuccess()
    {
        $response = $this->app()->handle(self::json(
            'GET',
            '/thumbs/5018093d-193b-466f-8aaf-c6993a91dcf4',
            ['filePath' => '/upload/5018093d193b466f8aafc6993a91dcf4/Screenshot from 2021-02-12 15-12-22.png'],
        ));

        $thumb = __DIR__.'/../../var/thumbs/4444-4444.jpg';

        self::assertEquals(200, $response->getStatusCode());
        self::assertFileExists($thumb);;
    }
}