<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionConnexionController extends AbstractController
{
    #[Route('/inscription/connexion', name: 'app_inscription_connexion')]
    public function index(): Response
    {
        return $this->render('inscription_connexion/index.html.twig', [
            'controller_name' => 'InscriptionConnexionController',
        ]);
    }
}
