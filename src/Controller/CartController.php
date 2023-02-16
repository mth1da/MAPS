<?php

namespace App\Controller;

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

    public function __construct(CartServices $services, SandwichRepository $sandwichRepository)
    {
        $this->services = $services;
        $this->sandwichRepository = $sandwichRepository;
    }

    #[Route('/cart', name: 'app_cart')]
    public function index(SessionInterface $session): Response
    {
        $dataPanier = [];
        $total = 0;

        $panier = $session->get("panier", []);
        foreach ($panier as $id => $quantite) {
            $sandwich = $this->sandwichRepository->find($id);
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
        $this->services->addOneSandwich($id, $session);
        //on redirige l'utilisateur vers le panier
        return $this->redirectToRoute("app_cart");
    }
    #[NoReturn] #[Route('/remove/{id}', name: 'remove')]
    public function remove(int $id, SessionInterface $session)
    {
        $this->services->removeOneSandwich($id, $session);

        return $this->redirectToRoute("app_cart");
    }

    #[NoReturn] #[Route('/delete', name: 'delete')]
    public function deleteAll(SessionInterface $session)
    {
        $session->remove("panier");

        return $this->redirectToRoute("app_cart");
    }
}
