<?php

namespace App\Repository;

use App\Entity\NotebookSkill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NotebookSkill|null find($id, $lockMode = null, $lockVersion = null)
 * @method NotebookSkill|null findOneBy(array $criteria, array $orderBy = null)
 * @method NotebookSkill[]    findAll()
 * @method NotebookSkill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotebookSkillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NotebookSkill::class);
    }

    // /**
    //  * @return NotebookSkill[] Returns an array of NotebookSkill objects
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
    public function findOneBySomeField($value): ?NotebookSkill
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
