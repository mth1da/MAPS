<?php

namespace App\Controller;

use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{
    #[Route('/booking', name: 'app_booking')]
    public function index( ReservationRepository $reservationRepository): Response
    {
        return $this->render('booking/index.html.twig', [
            'reservations' => $reservationRepository->findBy(['resa_user' => null]),
        ]);
    }

    #[Route('/booking/reservation/{id}', name: 'app_booking_reservation')]
    public function reservation($id, ReservationRepository $reservationRepository,
                                EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        try{
            if($session->get('currentEditReservationId') !== null){
                $reservation = $reservationRepository->find($session->get('currentEditReservationId'));
                $reservation->setResaUser(null);
            }
            $reservation = $reservationRepository->find($id);
            $reservation->setResaUser($this->getUser());
            $entityManager->flush();
            $session->set('currentEditReservationId', null);

            $this->addFlash('success', 'Réservation ajoutée avec succès.');
        } catch (Exception){
            $this->addFlash('danger', 'Un problème est survenu.');
        }

        return $this->redirectToRoute('app_account');
    }

    #[Route('/booking/remove/reservation/{id}', name: 'app_account_remove_reservation')]
    public function removeAccountReservation($id,ReservationRepository $reservationRepository,
                                             EntityManagerInterface $entityManager): Response
    {
        try{
            $reservation = $reservationRepository->find($id);
            $reservation->setResaUser(null);
            $entityManager->flush();
            $this->addFlash('success', 'Réservation supprimée avec succès.');
        } catch (Exception){
            $this->addFlash('danger', 'Un problème est survenu.');
        }

        return $this->redirectToRoute('app_account');
    }
}
