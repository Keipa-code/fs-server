<?php

declare(strict_types=1);


namespace App\Http\Action\DownloadFile;


use App\Upload\Command\GetPathName\Command;
use App\Upload\Command\GetPathName\Handler;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Ramsey\Uuid\Uuid;
use Slim\Psr7\Stream;
use SpazzMarticus\Tus\Services\FileService;

class RequestAction implements RequestHandlerInterface
{
    private ResponseFactoryInterface $responseFactory;
    private string $dir = '';
    private Handler $handler;
    private Command $command;

    public function __construct(
        ResponseFactoryInterface $responseFactory,
        Handler $handler,
        Command $command,
    )
    {
        $this->responseFactory = $responseFactory;
        $this->dir = realpath(__DIR__.'/../../../../var');
        $this->handler = $handler;
        $this->command = $command;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $uuid = Uuid::fromString(str_replace(
            '/upload/',
            '',
            $request->getUri()->getPath()
        ));
        $this->command->uuid = $uuid->toString();
        $file = $this->handler->handle($this->command);


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