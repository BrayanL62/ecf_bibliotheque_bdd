<?php

namespace App\Controller;

use App\Entity\Kind;
use App\Repository\KindRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KindController extends AbstractController
{
    /**
     * @Route("/kind", name="kind")
     */
    public function index(KindRepository $kindRepository): Response
    {
        return $this->render('kind/index.html.twig', [
            'kinds' => $kindRepository->findAll(),
        ]);
    }
}
