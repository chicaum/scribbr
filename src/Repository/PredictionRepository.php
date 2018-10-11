<?php

namespace App\Repository;

use App\Entity\Prediction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Prediction|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prediction|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prediction[]    findAll()
 * @method Prediction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PredictionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Prediction::class);
    }

    /**
     * @return Prediction[] Returns an array of Prediction objects
     */
    public function findByCityAndDate($city, $date)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.city = :val1')
            ->setParameter('val1', $city)
            ->andWhere('p.date = :val2')
            ->setParameter('val2', $date)
            ->orderBy('p.time', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
