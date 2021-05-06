<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use DomainException;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;
use Slim\Flash\Messages;

final class DomainExceptionHandler implements MiddlewareInterface
{
    private LoggerInterface $logger;
    private Messages $flash;
    private ResponseFactoryInterface $responseFactory;

    public function __construct(LoggerInterface $logger, Messages $flash, ResponseFactoryInterface $responseFactory)
    {
        $this->logger = $logger;
        $this->flash = $flash;
        $this->responseFactory = $responseFactory;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (DomainException $exception) {
            $this->logger->warning($exception->getMessage(), [
                'exception' => $exception,
                'url' => (string)$request->getUri(),
            ]);
            $this->flash->addMessage('danger', $exception->getMessage());
            $data = $request->getParsedBody();
            /** @var string $url */
            $url = $data['urlPath'] ?? $request->getUri()->getPath();
            return $this->responseFactory->createResponse()
                ->withStatus(409)
                ->withHeader('Location', $url);
        }
    }
}
