<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientsController extends AbstractController
{

    #[Route('/ingredient', name: 'app_ingredient')]
    public function index(IngredientRepository $ingredientRepository): Response
    {
        return $this->render('ingredients/index.html.twig',[
            'pains' => $ingredientRepository->findBySlug('pain'),
            'viandes' => $ingredientRepository->findBySlug('viande'),
            'poissons' => $ingredientRepository->findBySlug('poisson'),
            'fromages' => $ingredientRepository->findBySlug('fromage'),
            'crudites' => $ingredientRepository->findBySlug('crudites'),
            'plantes' => $ingredientRepository->findBySlug('plante'),
            'epices' => $ingredientRepository->findBySlug('epice'),
            'sauces' => $ingredientRepository->findBySlug('sauce'),
        ]);
    }
}
