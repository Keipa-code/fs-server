<?php

declare(strict_types=1);


namespace App\Upload\Command\FindFiles;


use App\Flusher;
use App\Upload\Entity\File;
use App\Upload\Entity\FileRepository;
use App\Upload\Entity\Id;

class Handler
{

    private FileRepository $files;

    public function __construct(FileRepository $files)
    {
        $this->files = $files;
    }

    public function handle(Command $command): array
    {
        $offset = 0;
        if ($command->pageNumber > 1) {
            $offset = (int)$command->pageNumber * 20;
        }
        if($command->query) {
            return $this->files->find(
                $command->query,
                $command->sort,
                $command->order,
                $offset,
                $command->rowCount,
            );
        }
        return $this->files->get(
            $command->sort,
            $command->order,
            $offset,
            $command->rowCount,
        );

    }
}