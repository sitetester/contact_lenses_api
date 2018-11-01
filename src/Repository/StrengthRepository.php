<?php

namespace App\Repository;

use App\Entity\Strength;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Strength|null find($id, $lockMode = null, $lockVersion = null)
 * @method Strength|null findOneBy(array $criteria, array $orderBy = null)
 * @method Strength[]    findAll()
 * @method Strength[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StrengthRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Strength::class);
    }

    public function findAllByNullCylinder(): array
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where('s.cylinder IS null');

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
}
