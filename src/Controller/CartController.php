<?php

namespace App\Controller;

use App\Entity\OriginalSandwich;
use App\Entity\Sandwich;
use App\Repository\OriginalSandwichRepository;
use App\Repository\SandwichRepository;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(SessionInterface $session, SandwichRepository $sandwichRepository): Response
    {
        $panier = $session->get("panier",[]);
        $dataPanier = [];
        $total = 0;

        foreach($panier as $id => $quantite){
            $sandwich = $sandwichRepository->find($id);
            $dataPanier[] = [
                "sandwich" => $sandwich,
                "quantite" => $quantite
            ];
            $total += $sandwich->getPrice() * $quantite;
        }

        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }

    #[NoReturn] #[Route('/add/{id}', name: 'add')]
    public function add(int $id, SessionInterface $session)
    {
        // On récupère le panier actuel
        $panier = $session->get("panier", []);
        //$id = $sandwich->getId();

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
}
