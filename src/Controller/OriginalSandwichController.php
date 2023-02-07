<?php

namespace App\Controller;

use App\Repository\OriginalSandwichRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OriginalSandwichController extends AbstractController
{
    #[Route('sandwich/original/', name: 'app_original_sandwich')]
    public function index(OriginalSandwichRepository $originalSandwichRepository): Response
    {
        return $this->render('original_sandwich/index.html.twig', [
            'orginalsSandwichs' => $originalSandwichRepository->findAll(),
        ]);
    }
}
