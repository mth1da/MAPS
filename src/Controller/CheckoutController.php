<?php

namespace App\Controller;

use App\Entity\Order;
use App\Service\StripeService;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CheckoutController extends AbstractController
{
    private StripeService $service;

    public function __construct(StripeService $service)
    {
        $this->service = $service;
    }

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
    public function validate(SessionInterface $session)
    {

        $panier = $session->get('panier');
        $dataPanier = $this->service->setPanier($session);

        if(isset($panier)){

            header('Content-Type: application/json');
            Stripe::setApiKey(self::API_KEY_TEST_STRIPE);

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
    public function success(SessionInterface $session, EntityManagerInterface $entityManager): Response
    {
        $order = new Order();

        $order->setOrderUser($this->getUser());
        $order->setCost($session->get("total")/100);

        $entityManager->persist($order);
        $entityManager->flush();

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
