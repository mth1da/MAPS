<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Config\SensioFrameworkExtraConfiguration\isGranted;

class IngredientsController extends AbstractController
{
    /**
    *@IsGranted("ROLE_EDITOR")
    *@Route("/article/nouveau", name="ajout_ingredient")
    */
    #[Route('/ingredients', name: 'app_ingredient')]
    public function index(): Response
    {
        return $this->render('ingredients/index.html.twig', [
            'controller_name' => 'IngredientsController',
        ]);
    }

    /**
     * @route("/ingredient/modifier/id", name="modif_ingredient")
     */
    public function modifIngredient(){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        //ici il faut être admin
    }
}
