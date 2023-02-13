<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Repository\IngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class SandwichController extends AbstractController
{
    #[Route('/sandwich', name: 'app_sandwich')]
    public function index(SessionInterface $session, IngredientRepository $ingredientRepository): Response
    {
        $panier = $session->get('ingredients', []);
        //$id = $ingredient->getId();

        $dataPanier = [];
        $total = 0;
        /* foreach ($panier as $id => $quantite){
             $ingredient = $ingredientRepository->find($id);
             $dataPanier[] = [
                 "ingredient" => $ingredient,
                 "quantité" => $quantite
             ];
             // $total += $ingredient->getPrice() * $quantite;
         }*/
        return $this->render('sandwich/index.html.twig', [
            'controller_name' => 'SandwichController',
            'ingredients' => $ingredientRepository->findAll(),
            "total" => $total,
            "dataPanier" => $panier
        ]);
    }
    #[Route('/sandwich/add/{id}', name: 'app_sandwich_add_basket')]
    public function addIngredient($id, Ingredient $ingredient, SessionInterface $session, IngredientRepository $ingredientRepository){
        $panier = $session->get('ingredients', []);
        $id = $ingredient->getId();
        /*foreach ($panier as $id => $quantite){
            $product = $ingredientRepository->find($id);
        }*/
        $session->set('ingredients', [
            'id' => $ingredientRepository->find($id)
        ]);
        return $this->redirectToRoute('app_sandwich');
    }
}
