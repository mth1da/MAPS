<?php

namespace App\Controller;

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
            if (isset($sandwich)) {
                $total += $sandwich->getPrice() * $quantite;
            }
        }

        return $this->render('cart/index.html.twig', compact("dataPanier", "total"));
    }

    #[NoReturn] #[Route('/add/{id}', name: 'add')]
    public function add(int $id, SessionInterface $session)
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
    #[NoReturn] #[Route('/remove/{id}', name: 'remove')]
    public function remove(int $id, SessionInterface $session)
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
