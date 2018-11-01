<?php

namespace App\Repository;

use App\Entity\Cylinder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Cylinder|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cylinder|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cylinder[]    findAll()
 * @method Cylinder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CylinderRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Cylinder::class);
    }

    public function filterByOption($option): array
    {
        $qb = $this->createQueryBuilder('c');
        $qb->where('c.option != :option')
            ->setParameter('option', $option)
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
}
