<?php

namespace App\Repository;

use App\Entity\ProductStructure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductStructure>
 *
 * @method ProductStructure|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductStructure|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductStructure[]    findAll()
 * @method ProductStructure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductStructureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductStructure::class);
    }

//    /**
//     * @return ProductStructure[] Returns an array of ProductStructure objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ProductStructure
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
