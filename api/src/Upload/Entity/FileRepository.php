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

    public function add(object $file): void
    {
        $this->em->persist($file);
    }

    public function find($value, $sort, $order, int $offset, int $limit): array
    {
        $qbp = $this->repo->createQueryBuilder('p');
        return $qbp->select('p')
            ->where($qbp->expr()->orX(
                $qbp->expr()->like('LOWER(p.filename)', '?1'),
                $qbp->expr()->like('LOWER(p.file_info)', '?1'),
            ))
            ->addOrderBy($sort, $order)
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->setParameter(1, '%' . addcslashes($value, '%_') . '%')
            ->getQuery()->getResult();
    }

    public function get($sort, $order, int $offset, int $limit)
    {
        $qb = $this->repo->createQueryBuilder('p');
        return $qb->select('p')
            ->addOrderBy($sort, $order)
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()->getResult();
    }

    public function getPathName($uuid): string
    {
        /** @var File $file */
        $file = $this->repo->findOneByUuidLink($uuid);
        return $file->getPathName();
    }
}