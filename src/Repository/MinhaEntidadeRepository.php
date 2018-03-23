<?php

namespace App\Repository;

use App\Entity\MinhaEntidade;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MinhaEntidade|null find($id, $lockMode = null, $lockVersion = null)
 * @method MinhaEntidade|null findOneBy(array $criteria, array $orderBy = null)
 * @method MinhaEntidade[]    findAll()
 * @method MinhaEntidade[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MinhaEntidadeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MinhaEntidade::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('m')
            ->where('m.something = :value')->setParameter('value', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
