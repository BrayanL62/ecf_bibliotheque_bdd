<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Borrowing;
use App\Entity\User;
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
        
        // // Afficher la liste des borrower dont la creation_date est inférieure à 01/03/2021
        // $borrowerDate = $borrowerRepository->findOneByDate('2021-03-01');
        // dump($borrowerDate);

        // // Afficher la liste des borrowers inactifs
        // $inactiveBorrower = $borrowerRepository->findByActive(false);
        // dump($inactiveBorrower);

        // // Requête pour les borrowings
        // // Afficher la liste des 10 derniers borrowings chronologiquement
        // $borrowings = $borrowingRepository->findByBorrowing();
        // dump($borrowings);

        // // Afficher la liste des emprunts du borrower dont l'id est 2
        // $borrowerId = $borrowingRepository->findByBorrowerId(2);
        // dump($borrowerId);

        // // Afficher la liste des emprunts du livre dont l'id est 3
        // $bookId = $borrowingRepository->findByBookId(3);
        // dump($bookId);

        // // Afficher la liste des emprunts qui ont été retournés avant le 01/01/2021
        // $borrowingDate = $borrowingRepository->findOneByReturnDate('2021-01-01');
        // dump($borrowingDate);

        // // Afficher la liste des emprunts qui n'ont pas encore été retournés 
        // $borrowingReturnDate = $borrowingRepository->findByReturnDate();
        // dump($borrowingReturnDate);
        
        // // Afficher les données de l'emprunt du livre dont l'id est 3 et qui n'a pas encore été retournés 
        // $borrowingIdAndReturnFalse = $borrowingRepository->findByIdAndReturn(3);
        // dump($borrowingIdAndReturnFalse);

        // Requête de d'ajout d'un emprunt 
        
        // $borrowers = $borrowerRepository->findAll();
        // $books = $bookRepository->findAll();

        // $newBorrowing = new Borrowing();
        // $newBorrowing->setBorrowingDate(\DateTime::createFromFormat('Y-m-d H:i:s', '2020-12-01 16:00:00'));
        // $newBorrowing->setBorrower($borrowers[0]);
        // $newBorrowing->setBook($books[0]);
        // $entityManager->persist($newBorrowing);
        // $entityManager->flush();

        // Requête de mise à jour

        // $thirdBorrowing = $borrowingRepository->findOneById(3);
        // $thirdBorrowing->setReturnDate(\DateTime::createFromFormat('Y-m-d H:i:s', '2020-05-01 10:00:00'));
        // $entityManager->persist($thirdBorrowing);
        // $entityManager->flush();

        // // Suppression du borrowing dont l'id est 3
        // $borrowing = $borrowingRepository->findOneById(3);
        // $entityManager->remove($borrowing);
        // $entityManager->flush();
        
        exit();
    }
}
