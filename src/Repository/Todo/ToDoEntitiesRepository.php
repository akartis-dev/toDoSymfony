<?php

namespace App\Repository\Todo;

use App\Entity\Todo\ToDoEntities;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ToDoEntities|null find($id, $lockMode = null, $lockVersion = null)
 * @method ToDoEntities|null findOneBy(array $criteria, array $orderBy = null)
 * @method ToDoEntities[]    findAll()
 * @method ToDoEntities[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ToDoEntitiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ToDoEntities::class);
    }

    // /**
    //  * @return ToDoEntities[] Returns an array of ToDoEntities objects
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
    public function findOneBySomeField($value): ?ToDoEntities
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
