<?php

namespace App\Service;

use App\Entity\Sandwich;
use App\Repository\SandwichRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartServices
{
    private SandwichRepository $sandwichRepository;

    public function __construct(SandwichRepository $sandwichRepository)
    {
        $this->sandwichRepository = $sandwichRepository;
    }

    public function creationDataPanier(Sandwich $sandwich, int $quantiteOrIngr) : array
    {
        $dataPanier[] = [
            "sandwich" => $sandwich,
            "quantite" => $quantiteOrIngr
        ];
        return $dataPanier;
    }

    public function recalculeTotal(Sandwich $sandwich, int $quantiteOrIngr, int $total) : int
    {
        if (isset($sandwich)) {
            $total += $sandwich->getPrice() * $quantiteOrIngr;
        }
        return $total;
    }
    public function addOneOriginalSandwich(int $id, SessionInterface $session) : void
    {
        $panier = $session->get("panier", []);
        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id] = 1;
        }
        $session->set("panier", $panier);
    }

    public function removeOneOriginalSandwich(int $id, SessionInterface $session) : void
    {
        $panier = $session->get("panier", []);

        if(!empty($panier[$id])){
            if($panier[$id] > 1){
                $panier[$id]--;
            }else{
                unset($panier[$id]);
            }
        }
        $session->set("panier", $panier);
    }

    public function addOneRandomSandwich(int $id, SessionInterface $session) : void
    {
        $panier = $session->get("panier", []);
        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id] = 1;
        }
        $session->set("panier", $panier);
    }

    public function removeOneRandomSandwich(int $id, SessionInterface $session) : void
    {
        $panier = $session->get("panier", []);

        if(!empty($panier[$id])){
            if($panier[$id] > 1){
                $panier[$id]--;
            }else{
                unset($panier[$id]);
            }
        }
        $session->set("panier", $panier);
    }
}