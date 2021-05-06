<?php

declare(strict_types=1);

use App\Manage\Command\Entity\Subscriber\SubscriberRepository;
use Doctrine\Common\Collections\Criteria;
use Psr\Container\ContainerInterface;

require __DIR__ . '/../vendor/autoload.php';

/** @var ContainerInterface $container */
$container = require __DIR__ . '/../conf/container.php';

$subs = $container->get(SubscriberRepository::class);

$em = $subs->getEm();
$fio = 'хан надежда романовна';
$qb = $subs->privateRepo->createQueryBuilder('p');


// Example - $qb->expr()->concat('u.firstname', $qb->expr()->concat($qb->expr()->literal(' '), 'u.lastname'))
$data = $qb->select('p')
    ->where($qb->expr()->orX(
        $qb->expr()->like(
            $qb->expr()->concat(
                $qb->expr()->concat(
                    'LOWER(p.surname)',
                    $qb->expr()->concat(
                        $qb->expr()->literal(' '),
                        'LOWER(p.firstname)'
                    )
                ),
                $qb->expr()->concat(
                    $qb->expr()->literal(' '),
                    'LOWER(p.patronymic)'
                )
            ),
            '?1'
        ),
        $qb->expr()->like(
            $qb->expr()->concat(
                $qb->expr()->concat(
                    'LOWER(p.surname)',
                    $qb->expr()->concat(
                        $qb->expr()->literal(' '),
                        'LOWER(p.patronymic)'
                    )
                ),
                $qb->expr()->concat(
                    $qb->expr()->literal(' '),
                    'LOWER(p.firstname)'
                )
            ),
            '?1'
        ),
        $qb->expr()->like(
            $qb->expr()->concat(
                $qb->expr()->concat(
                    'LOWER(p.firstname)',
                    $qb->expr()->concat(
                        $qb->expr()->literal(' '),
                        'LOWER(p.surname)'
                    )
                ),
                $qb->expr()->concat(
                    $qb->expr()->literal(' '),
                    'LOWER(p.patronymic)'
                )
            ),
            '?1'
        ),
        $qb->expr()->like(
            $qb->expr()->concat(
                $qb->expr()->concat(
                    'LOWER(p.firstname)',
                    $qb->expr()->concat(
                        $qb->expr()->literal(' '),
                        'LOWER(p.patronymic)'
                    )
                ),
                $qb->expr()->concat(
                    $qb->expr()->literal(' '),
                    'LOWER(p.surname)'
                )
            ),
            '?1'
        ),
        $qb->expr()->like(
            $qb->expr()->concat(
                $qb->expr()->concat(
                    'LOWER(p.patronymic)',
                    $qb->expr()->concat(
                        $qb->expr()->literal(' '),
                        'LOWER(p.firstname)'
                    )
                ),
                $qb->expr()->concat(
                    $qb->expr()->literal(' '),
                    'LOWER(p.surname)'
                )
            ),
            '?1'
        ),
        $qb->expr()->like(
            $qb->expr()->concat(
                $qb->expr()->concat(
                    'LOWER(p.patronymic)',
                    $qb->expr()->concat(
                        $qb->expr()->literal(' '),
                        'LOWER(p.surname)'
                    )
                ),
                $qb->expr()->concat(
                    $qb->expr()->literal(' '),
                    'LOWER(p.firstname)'
                )
            ),
            '?1'
        ),
    ))
    ->innerJoin('p.phonenumbers', 'n')
    ->setParameter(1, '%' . addcslashes($fio, '%_') . '%')
    ->getQuery()->getResult();



    $subs = [];
foreach ($data as $datum) {
    $subs[] = $datum->getInListFormat();
}

var_dump($subs);


/*$data = $qb->select('p')
    ->where($qb->expr()->orX(
        $qb->expr()->like('LOWER(p.firstname)', '?1'),
        $qb->expr()->like('LOWER(p.surname)', '?2'),
        $qb->expr()->like('LOWER(p.patronymic)', '?3')
    ))  //LOWER(p.firstname) LIKE :firstname
    ->innerJoin('p.phonenumbers', 'n')
    ->setParameter(1, '%хан%%надежда%%романовна%')
    ->setParameter(2, '%хан%%надежда%%романовна%')
    ->setParameter(3, '%хан%%надежда%%романовна%')
    ->getQuery()->getResult();*/
