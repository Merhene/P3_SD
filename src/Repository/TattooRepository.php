<?php

namespace App\Repository;

use App\Entity\Tattoo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tattoo>
 *
 * @method Tattoo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tattoo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tattoo[]    findAll()
 * @method Tattoo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TattooRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tattoo::class);
    }

//    /**
//     * @return Tattoo[] Returns an array of Tattoo objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Tattoo
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
