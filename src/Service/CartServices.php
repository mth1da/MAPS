<?php

namespace App\Service;
/*
use App\Repository\SandwichRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartServices
{
    private SandwichRepository $sandwichRepository;

    public function __construct(SandwichRepository $sandwichRepository)
    {
        $this->sandwichRepository = $sandwichRepository;
    }

    public function creationCart(SessionInterface $session, array $datapanier, float $total) : void
    {

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

    public function removeOneSandwich(int $id, SessionInterface $session) : void
    {
        $panier = $session->get("panier", []);

        if (!empty($panier[$id])) {
            unset($panier[$id]);
            $session->set("panier", $panier);
        }
    }

}
*\
 */