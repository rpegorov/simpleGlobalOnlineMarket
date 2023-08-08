<?php

namespace App\Repository;

use App\Entity\Products\Accessories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Accessories>
 *
 * @method Accessories|null find($id, $lockMode = null, $lockVersion = null)
 * @method Accessories|null findOneBy(array $criteria, array $orderBy = null)
 * @method Accessories[]    findAll()
 * @method Accessories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccessoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Accessories::class);
    }

//    /**
//     * @return Accessories[] Returns an array of Accessories objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Accessories
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
