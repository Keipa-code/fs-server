<?php


namespace App\Http\Listener;

use App\Upload\Command\UploadByTUS\Command;
use App\Upload\Command\UploadByTUS\Handler;
use DomainException;
use SpazzMarticus\Tus\Events\UploadComplete;

class Complete
{
    private Handler $handler;

    public function __construct(Handler $handler)
    {
        $this->handler = $handler;
    }

    public function handle(UploadComplete $event): void
    {
        $command = new Command();
        if (!$event->getFile()->getFilename()) {
            throw new DomainException('$event is empty');
        }
        $command->filename = $event->getFile()->getFilename() ?? '';
        $command->size = $event->getFile()->getSize() ?? '';
        $command->fileLink = $event->getFile()->getPathname() ?? '';
        $command->authorComment = $event->getFile()->getLinkTarget() ?? '';
        
        $this->handler->handle($command);
    }
}