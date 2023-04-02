<?php

namespace App\Service;

use App\Entity\Sandwich;
use App\Repository\IngredientRepository;
use App\Repository\SandwichRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartServices
{
    private SandwichRepository $sandwichRepository;

    public function __construct(SandwichRepository $sandwichRepository)
    {
        $this->sandwichRepository = $sandwichRepository;
    }

    public function creationDataPanier(Sandwich $sandwich,  $quantiteOrIngr) : array
    {
        $dataPanier[] = [
            "sandwich" => $sandwich,
            "quantite" => $quantiteOrIngr
        ];
        return $dataPanier;
    }

    public function recalculeTotal(Sandwich $sandwich,  $quantiteOrIngr, int $total) : int
    {
        if (isset($sandwich)) {
            $total += $sandwich->getPrice() * $quantiteOrIngr;
        }
        return $total;
    }
    public function addOneOriginalOrRandomSandwich(int $id, SessionInterface $session, IngredientRepository $ingredientRepository) : void
    {
        $panier = $session->get("panier", []);

        if(!empty($panier[$id])){
            $panier[$id]["quantite"]++;
        }else{
            $panier[$id] = 1;
        }
        $session->set("panier", $panier);
    }

    public function removeOneOriginalOrRandomSandwich(int $id, SessionInterface $session) : void
    {
        $panier = $session->get("panier", []);
        unset($panier[$id]);
        $session->set("panier", $panier);
    }

}