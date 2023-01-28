<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientsController extends AbstractController
{
    #[Route('/ingredients', name: 'app_ingredient')]
    public function index(): Response
    {
        return $this->render('ingredients/index.html.twig', [
            'controller_name' => 'IngredientsController',
        ]);
    }
}
