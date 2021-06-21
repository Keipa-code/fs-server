<?php

declare(strict_types=1);


namespace Test\Functional;


class GetThumbnail extends WebTestCase
{
    public function testCreateThumbsSuccess()
    {
        $response = $this->app()->handle(self::json(
            'GET',
            '/thumbs/4444-4444',
            ['filePath' => '/uploads/9a058e3585e74a10a35a87e40d41b4ce/Screenshot from 2021-02-12 15-12-22.png'],
        ));

        $thumb = __DIR__.'/../../var/thumbs/4444-4444.jpg';

        self::assertEquals(200, $response->getStatusCode());
        self::assertFileExists($thumb);;
    }
}