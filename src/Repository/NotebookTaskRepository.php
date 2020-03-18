<?php

namespace App\Repository;

use App\Entity\NotebookTask;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NotebookTask|null find($id, $lockMode = null, $lockVersion = null)
 * @method NotebookTask|null findOneBy(array $criteria, array $orderBy = null)
 * @method NotebookTask[]    findAll()
 * @method NotebookTask[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotebookTaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NotebookTask::class);
    }

    // /**
    //  * @return NotebookTask[] Returns an array of NotebookTask objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NotebookTask
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
