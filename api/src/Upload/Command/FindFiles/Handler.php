<?php

declare(strict_types=1);

namespace App\Upload\Command\FindFiles;

use App\Upload\Entity\FileRepository;
use Psr\Log\LoggerInterface;

final class Handler
{
    private FileRepository $files;
    private LoggerInterface $logger;

    public function __construct(FileRepository $files, LoggerInterface $logger)
    {
        $this->files = $files;
        $this->logger = $logger;
    }

    public function handle(Command $command): array
    {
        $offset = 0;
        if ($command->pageNumber > 1) {
            $offset = (int)$command->pageNumber * 5;
        }
        if ($command->query) {
            return $this->files->find(
                $command->query,
                $command->sort,
                $command->order,
                $offset,
                $command->rowCount,
            );
            //$this->logger->warning(implode('',$list));
        }
        return $this->files->get(
            $command->sort,
            $command->order,
            $offset,
            $command->rowCount,
        );
        //$this->logger->warning(json_encode($list));
    }
}
