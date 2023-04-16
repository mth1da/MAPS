<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Entity\Sandwich;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class SandwichController extends AbstractController
{
    #[Route('/sandwich', name: 'app_sandwich')]
    public function index(SessionInterface $session, IngredientRepository $ingredientRepository): Response
    {
        $content = $session->get('ingredients');
        $dataContenuSandwich = [];
        $totalIngBySandwich = 0;
        $totalIngBySandwichByQte = 0;
        $totalQte = 0;

        if(!empty($content)){
            foreach ($content as $id => $quantite){
                $ingredient = $ingredientRepository->find($id);
                if($ingredient != null){
                    $totalIngBySandwich += $ingredient->getPrice();
                    $totalIngBySandwichByQte += $ingredient->getPrice() * $quantite;
                }
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
            "contenu" => $content,
            "dataContenuSandwich" => $dataContenuSandwich
        ]);
    }

    public function initContent($content, $ingredientRepository, $totalIngBySandwich,
                                $totalIngBySandwichByQte, $totalQte, $dataContenuSandwich){
        if(!empty($content)){
            foreach ($content as $id => $quantite){
                $ingredient = $ingredientRepository->find($id);
                if($ingredient != null){
                    $totalIngBySandwich += $ingredient->getPrice();
                    $totalIngBySandwichByQte += $ingredient->getPrice() * $quantite;
                }
                $totalQte += $quantite;
                $dataContenuSandwich[] = [
                    "ingredient" => $ingredient,
                    "quantite" => $quantite,
                ];
                //$total+=$ingredient->getPtrice() * $quantite;
            }
        }
        return $dataContenuSandwich;
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

    #[Route('/sandwich/save', name: 'app_sandwich_save')]
    public function saveSandwich(SessionInterface $session, EntityManagerInterface $em)
    {
        $newSandwich = new Sandwich();
        $newSandwich->setIsMapse(true);
        $newSandwich->setName("sandwich utilisateur" . $newSandwich->getId());
        $price = 0.0;

        $sandwich = $session->get('sandwich');
            foreach ($sandwich as $ingredient) {
                if(!empty($ingredient)){;
                    $newSandwich->addSandwichIngredient($ingredient["ingredient"]);
                    $price += $ingredient["quantite"];
                    $em->persist($newSandwich);
                    $em->flush();
                }
            }
        $newSandwich->setPrice($price);

        return $this->redirectToRoute("app_sandwich");
    }
}
