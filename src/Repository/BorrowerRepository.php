<?php

namespace App\Repository;

use App\Entity\Borrower;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Borrower|null find($id, $lockMode = null, $lockVersion = null)
 * @method Borrower|null findOneBy(array $criteria, array $orderBy = null)
 * @method Borrower[]    findAll()
 * @method Borrower[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BorrowerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Borrower::class);
    }

    /**
     * @return Borrower[] Returns an array of Borrower objects
     */
    public function findByFirstnameOrLastname(string $value)
    {
        // Récupération d'un query builder.
        $qb = $this->createQueryBuilder('b');
        return $qb->where($qb->expr()->orX(
                $qb->expr()->like('b.firstname', ':value'),
                $qb->expr()->like('b.lastname', ':value')
            ))
            // Affactation d'une valeur à la variable :value.
            // Le symbole % est joker qui veut dire
            // « match toutes les chaînes de caractères ».
            ->setParameter('value', "%{$value}%")
            // Tri par firstname en ordre croissant (a, b, c, ...).
            ->orderBy('b.firstname', 'ASC')
            // En cas de firstname identiqu, on ajoute un tri par
            // lastname en ordre croissant (a, b, c, ...).
            ->orderBy('b.lastname', 'ASC')
            // Récupération d'une requête qui n'attend qu'à être exécutée.
            ->getQuery()
            // Exécution de la requête.
            // Récupération d'un tableau de résultat.
            // Ce tableau peut contenir, zéro, un ou plusieurs lignes.
            ->getResult()
        ;
    }

    public function findByNumber(string $value)
    {
        return $this->createQueryBuilder('b')
            ->where('b.phone_number LIKE :value')
            ->setParameter('value', "%{$value}%")
            ->orderBy('b.firstname', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneByActive(bool $value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.active = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    public function findOneByDate(string $value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.creation_date < :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
    * @return Borrower
    */
    public function findOneByUser(User $user, string $role = '')
    {
        return $this->createQueryBuilder('p')
            // Demande de jointure de l'objet user.
            // 'u' sera l'alias qui permet de désigner un user.
            ->leftJoin('p.user', 'u')
            // Ajout d'un filtre qui ne retient que le profil
            // qui possède une relation avec la variable :user.
            ->andWhere('p.user = :user')
            // Ajout d'un filtre qui ne retient que les users
            // qui contiennent (opérateur LIKE) la chaîne de
            // caractères contenue dans la variable :role.
            ->andWhere('u.roles LIKE :role')
            // Affectation d'une valeur à la variable :user.
            ->setParameter('user', $user)
            // Affectation d'une valeur à la variable :role.
            // Le symbole % est joker qui veut dire
            // « match toutes les chaînes de caractères ».
            ->setParameter('role', "%{$role}%")
            // Récupération d'une requête qui n'attend qu'à être exécutée.
            ->getQuery()
            // Exécution de la requête.
            // Récupération d'une variable qui peut contenir
            // un profil ou la valeur nulle.
            ->getOneOrNullResult()
        ;
    }

}
