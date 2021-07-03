<?php

declare(strict_types=1);


namespace App\Http\Action\GetTotalRowCount;


use App\Http\JsonResponse;
use App\Upload\Command\GetTotalRowCount\Command;
use App\Upload\Command\GetTotalRowCount\Handler;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RequestAction implements RequestHandlerInterface
{
    private Handler $handler;
    private Command $command;

    public function __construct(Handler $handler, Command $command)
    {
        $this->handler = $handler;
        $this->command = $command;
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     * @throws JsonException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = $request->getParsedBody();
        $this->command->query = $data['query'] ?? '';
        return new JsonResponse((int)$this->handler->handle($this->command));
    }
}