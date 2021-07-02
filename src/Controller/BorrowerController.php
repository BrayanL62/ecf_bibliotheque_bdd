<?php

namespace App\Controller;

use App\Entity\Borrower;
use App\Repository\BorrowerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BorrowerController extends AbstractController
{
    /**
     * @Route("/borrower", name="borrower")
     */
    public function index(BorrowerRepository $borrowerRepository): Response
    {
        return $this->render('borrower/index.html.twig', [
            'borrowers' => $borrowerRepository->findAll(),
        ]);
    }
}
