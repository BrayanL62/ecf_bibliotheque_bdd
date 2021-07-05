<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
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
        $loremBook = $bookRepository->findByTitle("lorem");
        dump($loremBook);

        exit();
    }
}
