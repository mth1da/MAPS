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

    public function creationDataPanier(Sandwich $sandwich,  $quantiteOrIngr) : array
    {
        $dataPanier[] = [
            "sandwich" => $sandwich,
            "quantite" => $quantiteOrIngr
        ];
        return $dataPanier;
    }

    public function addOneMapsSandwich(SessionInterface $session, ): void
    {
        $panier = $session->get("panier", []);
        $sandwich = $session->get('sandwich');

        $panier[] = $sandwich;
        $session->set("panier", $panier );
        $session->set('sandwich', null);
        $session->set('ingredients', null);
    }

    public function duplicateMapsSandwich(int $index, SessionInterface $session)
    {
        $panier = $session->get("panier", []);

        $panier[] = $panier[$index];

        $session->set("panier", $panier );
    }

    public function removeMapsSandwich(int $index, SessionInterface $session)
    {
        $panier = $session->get("panier", []);

        unset($panier[$index]);

        $session->set("panier", $panier );
    }

    public function addOneOriginalOrRandomSandwich(int $id, SessionInterface $session) : void
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