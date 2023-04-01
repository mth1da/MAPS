<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MappingController extends AbstractController
{
    #[Route('/mapping', name: 'app_mapping')]
    public function index(): Response
    {
        return $this->render('mapping/index.html.twig');
    }
}