<?php

declare(strict_types=1);

namespace App\Http\Action\GetThumbnail;

use App\Factory\Thumb;
use Exception;
use InvalidArgumentException;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Stream;

final class RequestAction implements RequestHandlerInterface
{
    private int $thumbWidth = 300;
    private int $thumbHeight = 200;
    private string $dir = '/var/www/var/';
    private ResponseFactoryInterface $responseFactory;

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * @throws Exception
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $file = $this->dir . $request->getUri()->getPath() . '.jpg';
        /**
         * @psalm-var array {
         * filePath:string
         * } $data
         */
        $data = $request->getParsedBody();
        if (!is_file($file)) {
            $sourceFile = $this->dir . $data['filePath'];
            if (!is_file($sourceFile)) {
                throw new InvalidArgumentException('Source file not found');
            }
            $image = new Thumb($sourceFile);
            $image->thumb($this->thumbWidth, $this->thumbHeight);
            $image->save($file, 60);
        }

        $openFile = fopen($file, 'rb');
        $stream = new Stream($openFile);
        $response = $this->createResponse();

        return $response
            ->withHeader('Content-Length', filesize($file))
            ->withHeader('Content-Disposition', 'attachment; filename="' . basename($file) . '"')
            ->withBody($stream);
    }

    private function createResponse(): ResponseInterface
    {
        $response = $this->responseFactory->createResponse(200);
        return $response
            ->withHeader('Content-Type', 'application/force-download')
            ->withHeader('Content-Type', 'application/octet-stream')
            ->withHeader('Content-Type', 'application/download')
            ->withHeader('Content-Description', 'File Transfer')
            ->withHeader('Content-Transfer-Encoding', 'binary')
            ->withHeader('Expires', '0')
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public');
    }
}
