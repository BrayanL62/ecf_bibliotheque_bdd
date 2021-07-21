<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app")
     */
    public function index(BookRepository $bookRepository): Response
    {
        $message = 'Hello Symfony!';

        return $this->render('app/index.html.twig', [
            'books' => $bookRepository->findAll(),
        ]);
    }
}
