<?php

declare(strict_types=1);

namespace App\Http\Action\FindFiles;

use App\Http\JsonResponse;
use App\Upload\Command\FindFiles\Command;
use App\Upload\Command\FindFiles\Handler;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class RequestAction implements RequestHandlerInterface
{
    private Handler $handler;
    private Command $command;

    public function __construct(Handler $handler, Command $command)
    {
        $this->handler = $handler;
        $this->command = $command;
    }

    /**
     * @throws JsonException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = $request->getQueryParams();
        $this->command->writeData($data);
        return new JsonResponse($this->handler->handle($this->command));
    }
}
