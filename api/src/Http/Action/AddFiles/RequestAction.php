<?php


namespace App\Http\Action\AddFiles;


use TusPhp\Tus\Server;

class RequestAction
{
    private string $uploadDir = __DIR__ . '/../../../../var/uploadedFiles';

    public function handle()
    {
        $tus = new Server;
        $tus->setUploadDir($this->uploadDir);
    }
}