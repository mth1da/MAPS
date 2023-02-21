<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use App\Repository\SandwichRepository;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
//use App\Service\CartServices;

class CartController extends AbstractController
{
    //private CartServices $services;
    private SandwichRepository $sandwichRepository;
    private IngredientRepository $ingredientRepository;

    public function __construct(SandwichRepository $sandwichRepository, IngredientRepository $ingredientRepository)
    {
        //$this->services = $services;
        $this->sandwichRepository = $sandwichRepository;
        $this->ingredientRepository = $ingredientRepository;
    }

    #[Route('/cart', name: 'app_cart')]
    public function index(SessionInterface $session): Response
    {

        $dataPanier = [];
        $total = 0;
        $panier = $session->get("panier", []);

        if (is_null($panier)){
            return $this->render('cart/index.html.twig', compact("panier"));
        }
        foreach ($panier as $id => $quantiteOrIngr) {
            if (is_array($quantiteOrIngr)){
                if (isset($quantiteOrIngringr['ingredient'])) {
                    $dataPanier[] = $quantiteOrIngr;
                    $total += $quantiteOrIngr['ingredient']->getPrice() * $quantiteOrIngr['quantite'];
                } else {
                    // handle the case where the 'ingredient' key is missing
                }
            }
            else{
                $sandwich = $this->sandwichRepository->find($id);
                $dataPanier[] = [
                    "sandwich" => $sandwich,
                    "quantite" => $quantiteOrIngr
                ];
                if (isset($sandwich)) {
                    $total += $sandwich->getPrice() * $quantiteOrIngr;
                }
            }
        }
        return $this->render('cart/index.html.twig', compact("dataPanier", "total", "panier"));
    }


    #[NoReturn] #[Route('/addMaps', name: 'app_cart_addMaps')]
    public function addMaps(SessionInterface $session)
    {
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
    #[NoReturn] #[Route('/addOriginal/{id}', name: 'addOriginal')]
    public function addOriginal(int $id, SessionInterface $session)
    {
        // On récupère le panier actuel
        $panier = $session->get("panier", []);

        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id] = 1;
        }

        // On sauvegarde dans la session
        $session->set("panier", $panier);

        //on redirige l'utilisateur vers le panier
        return $this->redirectToRoute("app_cart");
    }

    #[NoReturn] #[Route('/removeOriginal/{id}', name: 'removeOriginal')]
    public function removeOriginal(int $id, SessionInterface $session)
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

        return $this->redirectToRoute("app_cart");
    }

    #[NoReturn] #[Route('/delete', name: 'delete')]
    public function deleteAll(SessionInterface $session)
    {
        $session->remove("panier");

        return $this->redirectToRoute("app_cart");
    }
}