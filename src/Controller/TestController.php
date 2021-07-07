<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Book;
use App\Entity\Author;
use App\Repository\UserRepository;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use App\Repository\BorrowerRepository;
use App\Repository\BorrowingRepository;
use App\Repository\KindRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index(
        AuthorRepository $authorRepository,
        UserRepository $userRepository,
        BookRepository $bookRepository,
        BorrowerRepository $borrowerRepository,
        BorrowingRepository $borrowingRepository,
        KindRepository $kindRepository
    ): Response
    {
        // Récupération de l'entity manager
        $entityManager = $this->getDoctrine()->getManager();

        // Partie Récupération Test des User

        // // Récupération de tous les user.
        // $user = $userRepository->findAll();
        // dump($user);

        // // Récupération du user dont l'ID = 1
        // $userIdOne = $userRepository->findOneById(1);
        // dump($userIdOne);

        // // Récupération du user dont l'email est 'foo.foo@example.com'
        // $fooEmail = $userRepository->findOneBy(['email' => 'foo.foo@example.com']);
        // dump($fooEmail);

        // // Récupération des users dont le role est 'ROLE_BORROWER'
        // $borrowerRole = $userRepository->findByRole('ROLE_BORROWER');
        // dump($borrowerRole);

        // // Partie Récupération Test des Book

        // // Récupération de tous les Books
        // $books = $bookRepository->findAll();
        // dump($books);

        // // Récupération du Book Id 1
        // $firstBook = $bookRepository->findOneById(1);
        // dump($firstBook);

        // // Récupération des books comprennant 'lorem' dans le titre
        // $loremBook = $bookRepository->findByTitle("lorem");
        // dump($loremBook);

        // // Récupération de la liste des livres dont l'id de l'auteur est 2
        // $secondAuthorBooks = $bookRepository->findByAuthor(2);
        // dump($secondAuthorBooks);

        // // Récupération de la liste des livres dont le genre contient le mot "roman"
        // $roman = $bookRepository->findByKind('roman');
        // dump($roman);

        // $books = $bookRepository->findAll();
        // $lastBook = end($books);

        // if($lastBook->getTitle() != 'Totum autem id externum'){

        //     $authors = $authorRepository->findAll();
        //     $kinds = $kindRepository->findAll();
    
        //     $newBook = new Book();
        //     $newBook->setTitle('Totum autem id externum');
        //     $newBook->setPublicationYear(2020);
        //     $newBook->setNumberPages(300);
        //     $newBook->setIsbnCode('9790412882714');
        //     $newBook->setAuthor($authors[1]);
        //     $newBook->addKind($kinds[5]);
        //     $entityManager->persist($newBook);
    
        //     $entityManager->flush();
        // }

        // // Requête de modification d'un livre
        // $kinds = $kindRepository->findById(2);
        // $kindsId = $kindRepository->findById(5);

        // $secondBook = $bookRepository->findById(2);
        // $secondBook[0]->setTitle('Aperiendum est igitur');
        // $secondBook[0]->removeKind($kinds[0]);
        // $secondBook[0]->addKind($kindsId[0]);
        // $entityManager->persist($secondBook[0]);
        // $entityManager->flush();

        // // Requête de supression d'un livre
        // $deleteBook = $bookRepository->findById(123);
        // $entityManager->remove($deleteBook[0]);
        // $entityManager->flush();

        // // Requête pour les emprunteurs
        // // Afficher la liste complète
        // $allBorrower = $borrowerRepository->findAll();
        // dump($allBorrower);

        // // Afficher les données du borrower dont l'id est 3
        // $borrowerIdThree = $borrowerRepository->findById(3);
        // dump($borrowerIdThree);

        // // Afficher les données de l'emprunteur relié au user dont l'id est 3
        // $borrower = $userRepository->findById(3);
        // $userBorrower = $borrowerRepository->findOneByUser($borrower);
        // dump($userBorrower);

        // // Afficher la liste des borrower donc firstname or lastname contient le mot-clé "foo"
        // $borrowerName = $borrowerRepository->findByFirstnameOrLastname("foo");
        // dump($borrowerName);

        // // Afficher la liste des emrpunteurs donc le phoneNumber contient '1234'
        // $phoneBorrower = $borrowerRepository->findByNumber('1234');
        // dump($phoneBorrower);

        // // Afficher la liste des borrowers inactifs
        // $inactiveBorrower = $borrowerRepository->findByActive(false);
        // dump($inactiveBorrower);
        
        exit();
    }
}

// @Todo !!!
// // Afficher la liste des borrower dont la creation_date est inférieure à 01/03/2021