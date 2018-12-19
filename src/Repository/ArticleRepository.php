<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
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
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function search($price, $page) 
    {
        $stmt = $this->createQueryBuilder('art') 
                     ->innerJoin('art.categories', 'artC' ) 
                     ->addSelect('artC')
                     ->innerJoin('art.brand', 'artB' ) 
                     ->addSelect('artB')
                     ->innerJoin('art.tag', 'artT' ) 
                     ->addSelect('artT')
                     ->andWhere('art.name LIKE :term') 
                     ->setParameter(':term', '%');
                     
        //Système de tri
        if ($price == "upperprice"){
            $stmt->orderBy('art.price' , 'ASC');

        } else if($price == "lowerprice"){
            $stmt->orderBy('art.price', 'DESC');
        }
                    
        //Système de pagination
        $limit = 100;
        $stmt->setMaxResults($limit);
        $stmt->setFirstResult(($page-1) * $limit);

        //RESULTAT
        return $stmt->getQuery()->getResult();         
    }  

    public function showCase() 
    {
        $stmt = $this->createQueryBuilder('art') 
                     ->andWhere('art.showcase = :term') 
                     ->setParameter(':term', '1');
                    
        return $stmt->getQuery()->getResult();         
    }  



}