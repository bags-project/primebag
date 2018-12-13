<?php

namespace App\Repository;

use App\Entity\ArticleColor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ArticleColor|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleColor|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleColor[]    findAll()
 * @method ArticleColor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleColorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ArticleColor::class);
    }

    // /**
    //  * @return ArticleColor[] Returns an array of ArticleColor objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ArticleColor
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
