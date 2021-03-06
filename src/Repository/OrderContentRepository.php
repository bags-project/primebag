<?php

namespace App\Repository;

use App\Entity\OrderContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OrderContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderContent[]    findAll()
 * @method OrderContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderContentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OrderContent::class);
    }

    public function searchOrderContents() 
    {

        $stmt = $this->createQueryBuilder('ordContents') 
        ->innerJoin('ordContents.articleRef', 'ordR' )      
        ->addSelect('ordR');

        return $stmt->getQuery()->getResult();    

    }


}
