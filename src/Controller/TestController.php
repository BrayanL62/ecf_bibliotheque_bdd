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

        // Récupération du User dont l'id est 2.
        $user = $userRepository->findAll();

        dump($user);

        exit();
    }
}
