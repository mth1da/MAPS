<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use App\Repository\SandwichRepository;
use App\Service\CartServices;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    private CartServices $services;
    private SandwichRepository $sandwichRepository;
    private IngredientRepository $ingredientRepository;

    public function __construct(SandwichRepository $sandwichRepository, IngredientRepository $ingredientRepository, CartServices $services)
    {
        $this->services = $services;
        $this->sandwichRepository = $sandwichRepository;
        $this->ingredientRepository = $ingredientRepository;
    }

    #[Route('/cart', name: 'app_cart')]
    public function index(SessionInterface $session): Response
    {

        $dataPanier = [];
        $total = 0;
        $panier = $session->get("panier", []);
        $sessionTotal = $session->get("total", []);
        if (is_null($panier)){
            return $this->render('cart/index.html.twig', compact("panier"));
        }
        foreach ($panier as $id => $quantiteOrIngr) {
            if (is_array($quantiteOrIngr)){
                foreach ($quantiteOrIngr as $key => $item) {
                    if(isset($item['ingredient'])){
                        $total += $item['ingredient']->getPrice() * $item['quantite'];
                    }
                }
                $dataPanier[] = $quantiteOrIngr;

            /*    if (isset($quantiteOrIngr[$id]['ingredient'])) {
                    $dataPanier[] = $quantiteOrIngr;
                    $total += $quantiteOrIngr['ingredient']->getPrice() * $quantiteOrIngr['quantite'];
                } else {
                    // handle the case where the 'ingredient' key is missing
                }*/
            }
            else{
                $sandwich = $this->sandwichRepository->find($id);
                $dataPanier = $this->services->creationDataPanier($sandwich, $quantiteOrIngr);
                $total = $this->services->recalculeTotal($sandwich, $quantiteOrIngr, $total);
            }
        }
        $sandwiches = $this->sandwichRepository;

        return $this->render('cart/index.html.twig',
            compact("dataPanier", "total", "panier", "sandwiches"));
    }


    #[NoReturn] #[Route('/addMaps', name: 'app_cart_addMaps')]
    public function addMaps(SessionInterface $session)
    {
            $panier = $session->get("panier", []);
            $sandwich = $session->get('sandwich');

            $dataContenuSandwich = [];

            if(!empty($panier)){
                $dataContenuSandwich[] = [
                    $sandwich
                ];
            }else{
                $dataContenuSandwich = [$sandwich];
            }

            $panier=$session->get('panier');
            $panier[] = $sandwich;
            $session->set("panier", $panier );
            $session->set('sandwich', null);
            $session->set('ingredients', null);

        //on redirige l'utilisateur vers le panier
        return $this->redirectToRoute("app_cart");
    }
    #[NoReturn] #[Route('/duplicate/maps/{index}', name: 'app_cart_duplicate_maps')]
    public function duplicateMaps(int $index, SessionInterface $session)
    {
        $panier = $session->get("panier", []);

        $dataContenuSandwich = [];

        $panier[] = $panier[$index];

        $session->set("panier", $panier );
        //on redirige l'utilisateur vers le panier
        return $this->redirectToRoute("app_cart");
    }
    #[NoReturn] #[Route('/remove/maps/{index}', name: 'app_cart_remove_maps')]
    public function removeMaps(int $index, SessionInterface $session)
    {
        $panier = $session->get("panier", []);

        $dataContenuSandwich = [];

        unset($panier[$index]);

        $session->set("panier", $panier );

        //on redirige l'utilisateur vers le panier
        return $this->redirectToRoute("app_cart");
    }
    #[NoReturn] #[Route('/addOriginalOrRandom/{id}', name: 'addOriginalOrRandom')]
    public function addOriginalOrRandom(int $id, SessionInterface $session)
    {
        $this->services->addOneOriginalOrRandomSandwich($id, $session);
        return $this->redirectToRoute("app_cart");
    }

    #[NoReturn] #[Route('/removeOriginalOrRandom/{id}', name: 'removeOriginalOrRandom')]
    public function removeOriginalOrRandom(int $id, SessionInterface $session)
    {
        $this->services->removeOneOriginalOrRandomSandwich($id, $session);
        return $this->redirectToRoute("app_cart");
    }

    #[NoReturn] #[Route('/delete', name: 'delete')]
    public function deleteAll(SessionInterface $session)
    {
        $session->remove("panier");
        return $this->redirectToRoute("app_cart");
    }


}