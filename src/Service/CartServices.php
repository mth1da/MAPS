<?php

namespace App\Service;

use App\Entity\Sandwich;
use App\Repository\SandwichRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use function PHPUnit\Framework\isInstanceOf;

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
    public function addOneSandwich(SessionInterface $ingredientRepository) : void
    {
      /*  $panier = $session->get("panier", []);
        $ingredients = $session->get('ingredients');
        dd($ingredients);
        $dataContenuSandwich = [];
        $total = 0;
        foreach ($contenu as $id => $quantite){
            $ingredient = $ingredientRepository->find($id);
            $dataContenuSandwich[] = [
                "ingredient" => $ingredient,
                "quantité" => $quantite
            ];
            //$total+=$ingredient->getPrice() * $quantite;
        }

        if(!empty($panier)){
            $panier++;
        }else{
            $panier=[];

        }


        $session->set("panier", $panier);*/
    }

    public function removeOneSandwich(int $id, SessionInterface $session) : void
    {
        $panier = $session->get("panier", []);

        if (!empty($panier[$id])) {
            unset($panier[$id]);
            $session->set("panier", $panier);
        }
    }

    public function isOriginal(object $sandwich){
        if($sandwich.isInstanceOf(Sandwich::class)){
            return true;
            }
        else{
            return false;
        }
    }

}