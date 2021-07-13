<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * @param $title string d'un title
     * @return Book[] Returns an array of Book objects
     */
    public function findByTitle(string $value)
    {
        return $this->createQueryBuilder('s')
            ->where('s.title LIKE :value')
            ->setParameter('value', "%{$value}%")
            ->orderBy('s.title', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
    * @return Book[] Returns an array of Book objects
    */
    
    public function findByAuhtor(int $id)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.authorId = :id')
            ->setParameter('id', $id)
            ->orderBy('b.title', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByKind($kind)
    {
        return $this->createQueryBuilder('b')
            ->innerJoin('b.Kinds', 'k')
            ->andWhere('k.name LIKE :kind')
            ->setParameter('kind', "%{$kind}%")
            ->orderBy('b.title', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }


    

    /*
    public function findOneBySomeField($value): ?Book
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
