<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Form\EditPassType;
use App\Form\EditProfileType;
use App\Repository\PublicationRepository;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;



class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(ReservationRepository $reservationRepository, PublicationRepository $publicationRepository): Response
    {
        //dd($this->getUser()->getId());
        return $this->render('account/index.html.twig', [
            "reservations" => $reservationRepository->findBy(['resa_user' => $this->getUser()]),
            'publications' => $publicationRepository->findPublicationsByUserIdDescendingOrder($this->getUser()->getId()),
        ]);
    }

    #[Route('account/deletePublication', name: 'app_account_deletePublication')]
    public function deletePublication(int $publicationId): void
    {
        $entityManager = $this->getEntityManager();
        $publication = $entityManager->getRepository(Publication::class)->find($publicationId);

        if ($publication !== null) {
            $entityManager->remove($publication);
            $entityManager->flush();
        }
    }


    #[Route('/account/edit', name: 'app_account_edit')]
    public function editProfile(EntityManagerInterface $em, Request $request): Response
    {
        //on récupère le user connecté
        $user = $this->getUser();

        //on crée le formulaire
        $editForm = $this->createForm(EditProfileType::class, $user );

        //on traite la requête du form
        $editForm->handleRequest($request);

        if($editForm->isSubmitted() && $editForm->isValid()){
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Votre profil a bien été mis à jour');

            return $this->redirectToRoute('app_account');
        }
        return $this->render('account/editprofile.html.twig', [
            'editForm' => $editForm->createView(),
        ]);
    }


}
