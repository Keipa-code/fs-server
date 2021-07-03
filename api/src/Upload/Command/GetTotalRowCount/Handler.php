<?php

declare(strict_types=1);


namespace App\Upload\Command\GetTotalRowCount;


use App\Upload\Entity\FileRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

class Handler
{
    private FileRepository $files;

    public function __construct(FileRepository $files)
    {
        $this->files = $files;
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function handle(Command $command)
    {
        return $this->files->getRowCount($command->query);
    }
}