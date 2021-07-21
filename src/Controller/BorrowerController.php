<?php

namespace App\Controller;

use App\Entity\Borrower;
use App\Entity\Borrowing;
use App\Entity\User;
use App\Form\BorrowerType;
use App\Repository\BorrowerRepository;
use App\Repository\BorrowingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @Route("/borrower")
 */
class BorrowerController extends AbstractController
{
    /**
     * @Route("/", name="borrower_index", methods={"GET"})
     */
    public function index(BorrowerRepository $borrowerRepository): Response
    {
        return $this->render('borrower/index.html.twig', [
            'borrowers' => $borrowerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="borrower_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $borrower = new Borrower();
        $form = $this->createForm(BorrowerType::class, $borrower);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $borrower->getUser();
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('user')->get('plainPassword')->getData()
                )
            );
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($borrower);
            $entityManager->flush();

            return $this->redirectToRoute('borrower_index');
        }

        return $this->render('borrower/new.html.twig', [
            'borrower' => $borrower,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="borrower_show", methods={"GET"})
     */
    public function show(Borrower $borrower, BorrowerRepository $borrowerRepository): Response
    {
        if ($this->isGranted('ROLE_BORROWER')) {
            // L'utilisateur est un student

            // Récupération du compte de l'utilisateur qui est connecté
            $user = $this->getUser();

            // Récupèration du profil student
            $userBorrower = $borrowerRepository->findOneByUser($user);

            // Comparaison du profil demandé par l'utilisateur et le profil de l'utilisateur
            // Si les deux sont différents, on redirige l'utilisateur vers la page de son profil
            if ($borrower->getId() != $userBorrower->getId()) {
                throw new NotFoundHttpException();
            }
        }

        return $this->render('borrower/show.html.twig', [
            'borrower' => $borrower,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="borrower_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Borrower $borrower): Response

    {

        $form = $this->createForm(BorrowerType::class, $borrower);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('borrower_index');
        }

        return $this->render('borrower/edit.html.twig', [
            'borrower' => $borrower,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="borrower_delete", methods={"POST"})
     */
    public function delete(Request $request, Borrower $borrower): Response
    {
        if ($this->isCsrfTokenValid('delete'.$borrower->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($borrower);
            $entityManager->flush();
        }

        return $this->redirectToRoute('borrower_index');
    }

    private function redirectBorrower(string $route, Borrower $borrower, BorrowerRepository $borrowerRepository)
    {
        // On vérifie si l'utilisateur est un student
        // Note : on peut aussi utiliser in_array('ROLE_STUDENT', $user->getRoles()) au
        // lieu de $this->isGranted('ROLE_STUDENT').
        if ($this->isGranted('ROLE_BORROWER')) {
            // L'utilisateur est un student

            // Récupération du compte de l'utilisateur qui est connecté
            $user = $this->getUser();

            // Récupèration du profil student
            $userBorrower = $borrowerRepository->findOneByUser($user);

            // Comparaison du profil demandé par l'utilisateur et le profil de l'utilisateur
            // Si les deux sont différents, on redirige l'utilisateur vers la page de son profil
            if ($borrower->getId() != $userBorrower->getId()) {
                return $this->redirectToRoute($route, [
                    'id' => $userBorrower->getId(),
                ]);
            }
        }

        // Si aucune redirection n'est nécessaire, on renvoit une valeur nulle
        return null;
    }
}
