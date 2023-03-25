<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RandomSandwichController extends AbstractController
{
    #[Route('/random/sandwich', name: 'app_random_sandwich')]
    public function index(): Response
    {
        return $this->render('random_sandwich/index.html.twig', [
            'controller_name' => 'RandomSandwichController',
        ]);
    }
}
