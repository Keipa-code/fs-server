<?php

declare(strict_types=1);


namespace App\Http\Action\DownloadFile;


use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Stream;
use SpazzMarticus\Tus\Services\FileService;

class RequestAction implements RequestHandlerInterface
{
    private ResponseFactoryInterface $responseFactory;
    private FileService $fileService;

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
        $this->fileService = new FileService();
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {


        $openFile = fopen($file, 'rb');
        $stream = new Stream($openFile);
        $response = $this->createResponse();

        return $response
            ->withHeader('Content-Length', filesize($file))
            ->withHeader('Content-Disposition', 'attachment; filename="' . basename($file) . '"')
            ->withBody($stream);

    }

    protected function createResponse(int $code = 200, ResponseInterface $response = null): ResponseInterface
    {
        $response = $response ? $response->withStatus($code) : $this->responseFactory->createResponse($code);
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