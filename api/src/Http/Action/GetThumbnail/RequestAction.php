<?php

declare(strict_types=1);


namespace App\Http\Action\GetThumbnail;


use App\Factory\Thumb;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RequestAction implements RequestHandlerInterface
{
    private int $thumbWidth = 300;
    private int $thumbHeight = 200;
    private string $dir = '/var/www/var/';

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $file = $this->dir . $request->getUri()->getPath();
        $image = new Thumb(__DIR__ . '/image.png');
        $image->thumb(300, 200);
        $image->output();
    }
}