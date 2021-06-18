<?php


namespace App\Http\Listener;

use App\Upload\Command\UploadByTUS\Command;
use App\Upload\Command\UploadByTUS\Handler;
use App\Upload\Helper\GetID;
use DomainException;
use getID3;
use JsonException;
use SpazzMarticus\Tus\Events\UploadComplete;

class Complete
{
    private Handler $handler;
    private \Psr\Log\LoggerInterface $logger;

    public function __construct(Handler $handler, \Psr\Log\LoggerInterface $logger)
    {
        $this->handler = $handler;
        $this->logger = $logger;
    }

    /**
     * @throws JsonException
     */
    public function handle(UploadComplete $event): void
    {
        $command = new Command();
        if (!$event->getFile()->getFilename()) {
            throw new DomainException('$event is empty');
        }
        $this->logger->warning($event->getUuid());
        $getID3 = new getID3;
        $fileInfo = $getID3->analyze($event->getFile()->getPathname());
        $command->filename = $event->getFile()->getFilename() ?? '';
        $command->size = $event->getFile()->getSize() ?? '';

        $command->fileLink = $event->getFile()->getPathname() ?? '';
        $command->authorComment = $fileInfo['fileformat'] ?? '';
        
        $this->handler->handle($command);
    }
}