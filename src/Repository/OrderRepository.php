<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function searchOrder() 
    {

        $stmt = $this->createQueryBuilder('ord') 
        ->innerJoin('ord.orderContents', 'ordC' )      
        ->addSelect('ordC')
        ->innerJoin('ord.orderStatus', 'ordS' )      
        ->addSelect('ordS')
        ->innerJoin('ord.paymentMethod', 'ordPM' )      
        ->addSelect('ordPM');

        return $stmt->getQuery()->getResult();    

    }

}
