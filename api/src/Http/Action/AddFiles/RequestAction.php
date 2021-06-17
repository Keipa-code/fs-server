<?php


namespace App\Http\Action\AddFiles;



use App\Http\Service\Tus;

class RequestAction
{
    private string $uploadDir = __DIR__ . '/../../../../var/uploadedFiles';
    private Tus $tus;
    private \Psr\Log\LoggerInterface $logger;

    public function __construct(Tus $tus, \Psr\Log\LoggerInterface $logger)
    {
        $this->tus = $tus;
        $this->logger = $logger;
    }

    public function handle(): Tus
    {
        $this->tus->setAllowGetCalls(true, null);
        $this->tus->setLogger($this->logger);
        return $this->tus;
    }
}