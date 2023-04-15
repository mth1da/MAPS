<?php

namespace App\Controller;

use App\Repository\SandwichRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MapsSandwichController extends AbstractController
{
    #[Route('/maps/sandwich', name: 'app_maps_sandwich')]
    public function index(SandwichRepository $sandwichRepository): Response
    {
        return $this->render('maps_sandwich/index.html.twig', [
            'mapsSandwichs' => $sandwichRepository->findBy(['is_mapse' => true]),
        ]);
    }
}
