<?php

namespace App\Repository;

use App\Entity\Fotos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Fotos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fotos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fotos[]    findAll()
 * @method Fotos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FotosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fotos::class);
    }

    // /**
    //  * @return Fotos[] Returns an array of Fotos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Fotos
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
