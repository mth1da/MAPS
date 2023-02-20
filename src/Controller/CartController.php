<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use App\Repository\SandwichRepository;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CartServices;

class CartController extends AbstractController
{
    private CartServices $services;
    private $sandwichRepository;

    public function __construct(CartServices $services, SandwichRepository $sandwichRepository, IngredientRepository $ingredientRepository)
    {
        $this->services = $services;
        $this->sandwichRepository = $sandwichRepository;
    }

    #[Route('/cart', name: 'app_cart')]
    public function index(SessionInterface $session): Response
    {


        $dataPanier = [];
        $total = 0;

        $panier = $session->get("panier");

        if (is_null($panier)){
            return $this->render('cart/index.html.twig', compact("panier"));
        }
        foreach ($panier as $id => $ingr) {
            if (isset($ingr['ingredient'])) {
                $dataPanier[] = $ingr;
                $total += $ingr['ingredient']->getPrice() * $ingr['quantite'];
            } else {
                // handle the case where the 'ingredient' key is missing
            }
        }



        return $this->render('cart/index.html.twig', compact("dataPanier", "total", "panier"));
    }


    #[NoReturn] #[Route('/add', name: 'app_cart_add')]
    public function add( SessionInterface $session)
    {
        // $this->services->addOneSandwich($session);

        $panier = $session->get("panier", []);
        $sandwich = $session->get('sandwich');

        $dataContenuSandwich = [];

        if(!empty($panier)){
            $dataContenuSandwich[] = [$sandwich];
        }else{
            $dataContenuSandwich = [$sandwich];

        }
        $panier=$session->get('panier');
        dump($panier);
        $panier[]=$sandwich;
        $session->set("panier", $panier );
        dump($panier);
        $session->set('sandwich', null);
        $session->set('ingredients', null);


        //on redirige l'utilisateur vers le panier
        return $this->redirectToRoute("app_cart");
    }
    #[NoReturn] #[Route('/remove/{id}', name: 'app_cart_remove')]
    public function remove(int $id, SessionInterface $session)
    {
        $this->services->removeOneSandwich($id, $session);

        return $this->redirectToRoute("app_cart");
    }

    #[NoReturn] #[Route('/delete', name: 'app_cart_delete')]
    public function deleteAll(SessionInterface $session)
    {
        $session->remove("panier");

        return $this->redirectToRoute("app_cart");
    }
}