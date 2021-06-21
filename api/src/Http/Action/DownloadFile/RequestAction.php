<?php

declare(strict_types=1);


namespace App\Http\Action\DownloadFile;


use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
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
        $response = $this->createResponse(200)
            ->withBody($this->streamFactory->createStreamFromFile($targetFile->getPathname()));

        /**
         * Filename currently not escaped
         * @see https://stackoverflow.com/a/5677844
         */
        $response = $response->withHeader('Content-Length', (string)$this->fileService->size($targetFile))
            ->withHeader('Content-Disposition', 'attachment; filename="' . $targetFile->getFilename() . '"')
            ->withHeader('Content-Transfer-Encoding', 'binary');

        if (isset($storage['metadata']['type'])) {
            $response = $response->withHeader('Content-Type', $storage['metadata']['type']);
        }

        return $response;
    }

    protected function createResponse(int $code = 200, ResponseInterface $response = null): ResponseInterface
    {
        $response = $response ? $response->withStatus($code) : $this->responseFactory->createResponse($code);
        return $response
            ->withHeader('Cache-Control', 'no-store')
            ->withHeader('Tus-Resumable', '1.0.0');
    }
}