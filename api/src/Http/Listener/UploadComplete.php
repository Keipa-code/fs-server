<?php


namespace App\Http\Listener;

use App\Upload\Command\UploadByTUS\Command;
use App\Upload\Command\UploadByTUS\Handler;

class UploadComplete
{
    private Handler $handler;
    private Command $command;

    public function __construct(Handler $handler, Command $command)
    {
        $this->handler = $handler;
        $this->command = $command;
    }

    public function handle(\TusPhp\Events\TusEvent $event)
    {
        $request = $event->getFile()->details();
    }
}