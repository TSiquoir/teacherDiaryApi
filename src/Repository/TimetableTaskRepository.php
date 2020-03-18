<?php

namespace App\Repository;

use App\Entity\TimetableTask;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TimetableTask|null find($id, $lockMode = null, $lockVersion = null)
 * @method TimetableTask|null findOneBy(array $criteria, array $orderBy = null)
 * @method TimetableTask[]    findAll()
 * @method TimetableTask[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TimetableTaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TimetableTask::class);
    }

    // /**
    //  * @return TimetableTask[] Returns an array of TimetableTask objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TimetableTask
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
