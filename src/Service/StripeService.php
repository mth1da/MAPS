<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class StripeService
{
    public function setPanier(SessionInterface $session)
    {

        $panier = $session->get('panier');
        $total = $session->get('total');
        $dataPanier = [];

        foreach ($panier as $id => $quantiteOrIngr) {
            if(isset($quantiteOrIngr['sandwich'])){
                $dataPanier[] = [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $quantiteOrIngr['sandwich']->getName(),
                            'metadata' => [
                                'id_product' => $quantiteOrIngr['sandwich']->getId(),
                                'quantity' => $quantiteOrIngr['quantite']
                            ],
                        ],
                        'unit_amount' => (int)$quantiteOrIngr['sandwich']->getPrice()
                    ],
                    'quantity' =>  $quantiteOrIngr['quantite'],
                ];
                $total += $quantiteOrIngr['sandwich']->getPrice() * $quantiteOrIngr['quantite'];
            }else {
                foreach ($quantiteOrIngr as $key => $item) {
                    if (is_array($item) /*|| isset($item['ingredient'])*/) {
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
            }
        }
        return $dataPanier;
    }
}