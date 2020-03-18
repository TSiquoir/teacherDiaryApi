<?php

namespace App\Repository;

use App\Entity\NotebookSubject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NotebookSubject|null find($id, $lockMode = null, $lockVersion = null)
 * @method NotebookSubject|null findOneBy(array $criteria, array $orderBy = null)
 * @method NotebookSubject[]    findAll()
 * @method NotebookSubject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotebookSubjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NotebookSubject::class);
    }

    // /**
    //  * @return NotebookSubject[] Returns an array of NotebookSubject objects
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
    public function findOneBySomeField($value): ?NotebookSubject
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
