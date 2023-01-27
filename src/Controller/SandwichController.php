<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SandwichController extends AbstractController
{
    #[Route('/sandwich', name: 'app_sandwich')]
    public function index(): Response
    {
        return $this->render('sandwich/index.html.twig', [
            'controller_name' => 'SandwichController',
        ]);
    }
}
