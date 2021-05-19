<?php


namespace App\Upload\Entity;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class FileRepository
{
    private EntityManagerInterface $em;
    private EntityRepository $repo;

    public function __construct(EntityManagerInterface $em, EntityRepository $repo)
    {
        $this->em = $em;
        $this->repo = $repo;
    }

    public function add(object $subscriber): void
    {
        $this->em->persist($subscriber);
    }
}