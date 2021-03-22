<?php

namespace App\Repository;

use App\Entity\FichePeda;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FichePeda|null find($id, $lockMode = null, $lockVersion = null)
 * @method FichePeda|null findOneBy(array $criteria, array $orderBy = null)
 * @method FichePeda[]    findAll()
 * @method FichePeda[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FichePedaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FichePeda::class);
    }

    // /**
    //  * @return FichePeda[] Returns an array of FichePeda objects
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
    public function findOneBySomeField($value): ?FichePeda
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
