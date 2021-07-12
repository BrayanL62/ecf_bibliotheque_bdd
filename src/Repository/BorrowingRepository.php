<?php

namespace App\Repository;

use App\Entity\Borrowing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Borrowing|null find($id, $lockMode = null, $lockVersion = null)
 * @method Borrowing|null findOneBy(array $criteria, array $orderBy = null)
 * @method Borrowing[]    findAll()
 * @method Borrowing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BorrowingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Borrowing::class);
    }

    /**
     * @return Borrowing[] Returns an array of Borrowing objects
     */

    public function findByBorrowing()
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.borrowing_date', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    public function findByReturnDate()
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.return_date IS NULL')
            // ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneByReturnDate(string $value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.return_date < :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByBorrowerId($value)
    {
        return $this->createQueryBuilder('b')
            ->innerJoin('b.borrower', 'k')
            ->andWhere('k.id = :value')
            ->setParameter('value', $value)
            // ->orderBy('b.title', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    // public function findByKind($kind)
    // {
    //     return $this->createQueryBuilder('b')
    //         ->innerJoin('b.kind', 'k')
    //         ->andWhere('k.name LIKE :kind')
    //         ->setParameter('kind', "%{$kind}%")
    //         ->orderBy('b.title', 'ASC')
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }

//     public function findByBorrowerId(int $value)
//     {
//         return $this->createQueryBuilder('b')
//             ->andWhere('b.borrower_id = :val')
//             ->setParameter('val', $value)
//             ->getQuery()
//             ->getResult()
//         ;
//     }
}
