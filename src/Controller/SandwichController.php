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
        $panier=$session->get('panier');
        $contenu= $session->get('ingredients');
        //$id = $ingredient->getId();
        $dataContenuSandwich = [];

        $totalIngBySandwich = 0;
        $totalIngBySandwichByQte = 0;
        $totalQte = 0;
        if(!empty($contenu)){
            foreach ($contenu as $id => $quantite){
                $ingredient = $ingredientRepository->find($id);
                $totalIngBySandwich += $ingredient->getPrice();
                $totalIngBySandwichByQte += $ingredient->getPrice() * $quantite;
                $totalQte += $quantite;
                $dataContenuSandwich[] = [
                    "ingredient" => $ingredient,
                    "quantite" => $quantite,
                ];
                //$total+=$ingredient->getPtrice() * $quantite;
            }
        }
        $dataContenuSandwich['totalIngBySandwich'] = $totalIngBySandwich;
        $dataContenuSandwich['totalIngBySandwichByQte'] = $totalIngBySandwichByQte;
        $dataContenuSandwich['totalQte'] = $totalQte;
        $session->set('sandwich', $dataContenuSandwich);

        return $this->render('sandwich/index.html.twig', [
            'controller_name' => 'SandwichController',
            'ingredients' => $ingredientRepository->findAll(),
            "total" => $totalIngBySandwich,
            "contenu" => $contenu,
            "dataContenuSandwich" => $dataContenuSandwich
        ]);

    }
    #[Route('/sandwich/add/{id}', name: 'app_sandwich_add_basket')]
    public function addIngredient($id, Ingredient $ingredient, SessionInterface $session, IngredientRepository $ingredientRepository){
        $contenu = $session->get('ingredients', []);
        $id = $ingredient->getId();

        if(!empty($contenu[$id])){
            $contenu[$id]++;
        }else{
            $contenu[$id]=1;
        }

        $session->set('ingredients', $contenu);

        return $this->redirectToRoute('app_sandwich');
    }


    // sert a soustraire 1 quantité d'un ingredient
    #[Route('/sandwich/remove/{id}', name: 'app_sandwich_remove_basket')]
    public function removeIngredient($id, Ingredient $ingredient, SessionInterface $session, IngredientRepository $ingredientRepository){
        $contenu = $session->get('ingredients', []);
        $id = $ingredient->getId();
        if(!empty($contenu[$id])){
            if($contenu[$id] > 1) {
                $contenu[$id]--;
            } else {
                unset($contenu[$id]);
            }
        }
        $session->set("ingredients", $contenu);
        return $this->redirectToRoute('app_sandwich');
    }

    // sert a supprimer toutes les quantité d'un ingredient
    #[Route('/sandwich/delete/{id}', name: 'app_sandwich_delete')]
    public function deleteIngredient($id, Ingredient $ingredient, SessionInterface $session, IngredientRepository $ingredientRepository){
        $contenu = $session->get('ingredients', []);
        $id = $ingredient->getId();
        if(!empty($contenu[$id])){
            unset($contenu[$id]);
        }
        $session->set("ingredients", $contenu);
        return $this->redirectToRoute('app_sandwich');
    }
    // sert a supprimer tous le sandwich
    #[Route('/sandwich/delete', name: 'app_sandwich_delete_all')]
    public function deleteAllIngredient(SessionInterface $session){
        $session->remove("ingredients");
        return $this->redirectToRoute('app_sandwich');
    }
}
