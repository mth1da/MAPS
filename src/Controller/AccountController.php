<?php

namespace App\Controller;

use App\Form\EditPassType;
use App\Form\EditProfileType;
use App\Repository\PublicationRepository;
use App\Repository\ReservationRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;



class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(ReservationRepository $reservationRepository, PublicationRepository $publicationRepository): Response
    {

        return $this->render('account/index.html.twig', [
            "reservations" => $reservationRepository->findBy(['resa_user' => $this->getUser()]),
            'publications' => $publicationRepository->findPublicationsByUserIdDescendingOrder($this->getUser()->getId()),
        ]);
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







    #[Route('/account/current/edit/reservation/{id}', name: 'app_account_save_current_edit_reservation')]
    public function saveEditReservation($id, SessionInterface $session): Response
    {
        $session->get('currentEditReservationId');
        $session->set('currentEditReservationId', $id);
        return $this->redirectToRoute('app_booking');
    }



    public function showUserProfile(int $userId, PublicationRepository $publicationRepository, UserRepository $userRepository)
    {
        return $this->render('user/profile.html.twig', [
            'user' => $userRepository->find($userId),
            'publications' => $publicationRepository->findPublicationsByUserIdDescendingOrder($userId),
        ]);
    }



    #[Route('account/removePublication', name: 'app_account_removePublication')]
    public function removePublication(int $publicationId): void
    {
        $entityManager = $this->getEntityManager();
        $publication = $entityManager->getRepository(Publication::class)->find($publicationId);

        if ($publication !== null) {
            $entityManager->remove($publication);
            $entityManager->flush();
        }
    }



}
