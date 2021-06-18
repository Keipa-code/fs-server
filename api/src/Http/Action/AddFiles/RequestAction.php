<?php


namespace App\Http\Action\AddFiles;


use App\Http\Listener\Complete;
use App\Http\Service\Tus;
use App\Upload\Command\UploadByTUS\Handler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;

class RequestAction implements RequestHandlerInterface
{
    private Tus $tus;
    private LoggerInterface $logger;
    private Handler $handler;

    public function __construct(
        Tus $tus,
        Handler $handler,
        LoggerInterface $logger,
    )
    {
        $this->tus = $tus;
        $this->handler = $handler;
        $this->logger = $logger;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->tus->setAllowGetCalls(true, null);
        $this->tus->setLogger($this->logger);
        $listener = new Complete($this->handler, $this->logger);
        $this->tus->addCompleteListener($listener, 'handle');
        return $this->tus->handle($request);
    }
}