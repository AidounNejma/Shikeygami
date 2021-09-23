<?php

namespace App\Repository;

use App\Entity\Calendar;
use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Calendar|null find($id, $lockMode = null, $lockVersion = null)
 * @method Calendar|null findOneBy(array $criteria, array $orderBy = null)
 * @method Calendar[]    findAll()
 * @method Calendar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalendarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Calendar::class);
    }

    /**
     * @return Calendar[] Returns an array of Calendar objects
     */
    
    public function calendarDesc()
    {
        return $this->createQueryBuilder('c')
        ->orderBy('c.id', 'DESC')
        ->setMaxResults(10)
        ->getQuery()
        ->getResult()
        ;
    }

    /* recherche si le jeu à été réservé */
    /* Methode à revoir */
    // public function isBooked()
    // {
    //     return $this->createQueryBuilder('c')
    //         ->join(Order::class, 'o', 'WITH', 'o.calendar = c.id')
    //         ->andWhere('o.paymentStatus = 2')
    //         ->getQuery()
    //         ->getResult();
    // }

    /*
    public function findOneBySomeField($value): ?Calendar
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
