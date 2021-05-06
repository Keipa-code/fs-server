<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Http\Validator\ValidationException;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Flash\Messages;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class ValidationExceptionHandler implements MiddlewareInterface
{
    private Messages $flash;
    private ResponseFactoryInterface $responseFactory;

    public function __construct(Messages $flash, ResponseFactoryInterface $responseFactory)
    {
        $this->flash = $flash;
        $this->responseFactory = $responseFactory;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (ValidationException $exception) {
            /** @var string[] $errors */
            $errors = self::errorsArray($exception->getViolations());
            foreach ($errors as $error) {
                $this->flash->addMessage('danger', $error);
            }
            //$this->flash->addMessage('danger', self::errorsArray($exception->getViolations()));

            $data = $request->getParsedBody();
            /** @var string $url */
            $url = $data['urlPath'] ?? $request->getUri()->getPath();
            return $this->responseFactory->createResponse()
                ->withStatus(422)
                ->withHeader('Location', $url);
        }
    }

    private static function errorsArray(ConstraintViolationListInterface $violations): array
    {
        $errors = [];
        /** @var ConstraintViolationInterface $violation */
        foreach ($violations as $violation) {
            $errors[$violation->getPropertyPath()] = $violation->getMessage();
        }
        return $errors;
    }
}
