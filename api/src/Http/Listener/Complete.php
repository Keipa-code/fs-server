<?php


namespace App\Http\Listener;

use App\Upload\Command\UploadByTUS\Command;
use App\Upload\Command\UploadByTUS\Handler;

class Complete
{
    private Handler $handler;

    public function __construct(Handler $handler)
    {
        $this->handler = $handler;
    }

    public function handle(\TusPhp\Events\TusEvent $event): void
    {
        /**
         * @var array<string, string> $fileInfo
         */
        $fileInfo = $event->getFile()->details();
        $command = new Command();
        $command->filename = $fileInfo['name'] ?? '';
        $command->size = $fileInfo['size'] ?? '';
        $command->fileLink = $fileInfo['file_path'] ?? '';
        $command->authorComment = $fileInfo['offset'] ?? '';
        
        $this->handler->handle($command);
    }
}