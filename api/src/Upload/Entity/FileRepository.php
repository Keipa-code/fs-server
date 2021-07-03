<?php


namespace App\Upload\Entity;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

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
        $qb = $this->repo->createQueryBuilder('p');
        return $qb->select('p')
            ->where($qb->expr()->like('LOWER(p.filename)', '?1'))
            ->addOrderBy('p.'.$sort, $order)
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->setParameter(1, '%' . addcslashes($value, '%_') . '%')
            ->getQuery()->getArrayResult();
    }

    public function get($sort, $order, int $offset, int $limit)
    {
        $qb = $this->repo->createQueryBuilder('p');
        return $qb->select('p')
            ->addOrderBy('p.'.$sort, $order)
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()->getArrayResult();
    }

    public function getPathName($uuid): string
    {
        /** @var File $file */
        $file = $this->repo->findOneByUuidLink($uuid);
        return $file->getPathName();
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function getRowCount($query = null)
    {
        $qb = $this->repo->createQueryBuilder('p');
        if($query == null) {
            return $qb->select('p')
                ->select('count(p.id)')
                ->getQuery()
                ->getSingleScalarResult();
        }
        return $qb->select('p')
            ->where($qb->expr()->like('LOWER(p.filename)', '?1'))
            ->select('count(p.id)')
            ->setParameter(1, '%' . addcslashes($query, '%_') . '%')
            ->getQuery()
            ->getSingleScalarResult();
    }
}