<?php

namespace App\Repository;

use App\Entity\Products\Headphone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Headphone>
 *
 * @method Headphone|null find($id, $lockMode = null, $lockVersion = null)
 * @method Headphone|null findOneBy(array $criteria, array $orderBy = null)
 * @method Headphone[]    findAll()
 * @method Headphone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HeadphoneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Headphone::class);
    }

//    /**
//     * @return Headphone[] Returns an array of Headphone objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Headphone
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
