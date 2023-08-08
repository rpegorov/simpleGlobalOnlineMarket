<?php

namespace App\Repository;

use App\Entity\RefreshToken;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;
use Gesdinet\JWTRefreshTokenBundle\Entity\RefreshTokenRepository;

class AccessTokenRepository extends RefreshTokenRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, RefreshToken::class);
    }

    public function save(RefreshToken $entity, bool $flush = false): void {
        $this->getEntityManager()->persist($entity);

        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RefreshToken $entity, bool $flush = false): void {
        $this->getEntityManager()->remove($entity);

        if($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByExampleField($value): array {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findOneByValue($value): ?RefreshToken {
        try {
            return $this->createQueryBuilder('a')
                ->andWhere('a.value = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult();
        } catch(NonUniqueResultException $e) {
            throw new NonUniqueResultException("Ошибка получения данных $e");
        }
    }
}
