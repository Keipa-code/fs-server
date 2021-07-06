<?php

declare(strict_types=1);

namespace App\Upload\Command\GetPathName;

use App\Upload\Entity\FileRepository;

final class Handler
{
    private FileRepository $files;

    public function __construct(FileRepository $files)
    {
        $this->files = $files;
    }

    public function handle(Command $command): string
    {
        return $this->files->getPathName($command->uuid);
    }
}
