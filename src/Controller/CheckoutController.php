<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use JetBrains\PhpStorm\NoReturn;
use Stripe\Exception\ApiErrorException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CheckoutController extends AbstractController
{
    CONST API_KEY_TEST_STRIPE = 'sk_test_51MeZo7AcMBtMl4zFPKo7CTtdYB2Agp8EbJPK3BaWT69btAyp4hkgJRZIVGoQahBvegYTLe7SfvPkgFLbAvKFqbMS00wnFdegkd';
    #[Route('/checkout', name: 'app_checkout')]
    public function index(SessionInterface $session): Response
    {
        $total = $session->get('total');
        return $this->render('checkout/index.html.twig', [
            'controller_name' => 'CheckoutController',
            'total' => $total
        ]);
    }

    /**
     * @throws ApiErrorException
     */
    #[Route('/checkout/validate', name: 'app_checkout_validate')]
    public function validate(SessionInterface $session, IngredientRepository $ingredientRepository)
    {
        $panier = $session->get('panier');
        $total = $session->get('total');
        $dataPanier = [];
        foreach ($panier as $id => $quantiteOrIngr) {
            if (is_array($quantiteOrIngr)) {
                foreach ($quantiteOrIngr as $key => $item) {
                    if (isset($item['ingredient'])) {
                        $dataPanier[] = [
                            'price_data' => [
                                'currency' => 'eur',
                                'product_data' => [
                                    'name' => $item['ingredient']->getName(),
                                    'metadata' => [
                                        'id_product' => $item['ingredient']->getId(),
                                        'quantity' => $item['quantite']
                                    ],
                                ],
                                'unit_amount' => (int)$item['ingredient']->getPrice()
                            ],
                            'quantity' =>  $item['quantite'],
                        ];
                        $total += $item['ingredient']->getPrice() * $item['quantite'];
                    }
                }
                //$dataPanier[] = $quantiteOrIngr;
            }
        }
        if(isset($panier)){
            //$stripe = new \Stripe\StripeClient(self::API_KEY_TEST_STRIPE);
            header('Content-Type: application/json');
            //Stripe::setApiKey($);
            \Stripe\Stripe::setApiKey(self::API_KEY_TEST_STRIPE);
            $YOUR_DOMAIN = $this->getParameter('app.host');
       /*     $t = $stripe->products->create(['name' => 'T-shirt']);

            dd($t);
            $stripe->prices->create(
                ['product' => '{{PRODUCT_ID}}'
                    ,'unit_amount' => 2000, 'currency' => 'eur']
            );*/
            try {

                $checkout_session = \Stripe\Checkout\Session::create([
                    'line_items' => $dataPanier,
                    'mode' => 'payment',
                    'success_url' => $this->generateUrl('app_checkout_success', [], UrlGeneratorInterface::ABSOLUTE_URL),
                    'cancel_url' => $this->generateUrl('app_checkout_cancel', [], UrlGeneratorInterface::ABSOLUTE_URL),

                ]);

                header("HTTP/1.1 303 See Other");
                header("Location: " . $checkout_session->url);
            }
            catch (ApiErrorException $e){
                dd($e);
            }
        }
        else{
            return $this->redirectToRoute('app_cart');
        }
       return $this->redirect( $checkout_session->url, 303);
    }
    #[Route('/checkout/success', name: 'app_checkout_success')]
    public function success(SessionInterface $session): Response
    {
        $session->remove('panier');

        $url = $this->generateUrl('app_homepage');
        return $this->render('checkout/success.html.twig', [
            'controller_name' => 'CheckoutController',
        ]);
    }
    #[Route('/checkout/cancel', name: 'app_checkout_cancel')]
    public function cancel(SessionInterface $session): Response
    {

        return $this->render('checkout/cancel.html.twig', [
            'controller_name' => 'CheckoutController',
        ]);
    }
}
