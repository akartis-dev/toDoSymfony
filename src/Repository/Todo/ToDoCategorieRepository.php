<?php

namespace App\Repository\Todo;

use App\Entity\Todo\ToDoCategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ToDoCategorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method ToDoCategorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method ToDoCategorie[]    findAll()
 * @method ToDoCategorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ToDoCategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ToDoCategorie::class);
    }

    // /**
    //  * @return ToDoCategorie[] Returns an array of ToDoCategorie objects
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
    public function findOneBySomeField($value): ?ToDoCategorie
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
