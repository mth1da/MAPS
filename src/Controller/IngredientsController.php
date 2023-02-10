<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientsController extends AbstractController
{

    #[Route('/article/nouveau', name: 'ajout_ingredient')]
    public function index(): Response
    {
        return $this->render('ingredients/index.html.twig', [
            'controller_name' => 'IngredientsController',
        ]);
    }

    #[Route('/ingredient/modifier/id', name: 'modif_ingredient')]
    public function modifIngredient(){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        //ici il faut être admin
    }
}
