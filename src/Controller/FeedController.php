<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PublicationRepository;

class FeedController extends AbstractController
{
    #[Route('/feed', name: 'app_feed')]
    public function index(PublicationRepository $publicationRepository): Response
    {
        return $this->render('feed/index.html.twig', [
            'publications' => $publicationRepository->findAllByDescendingOrder(),
        ]);
    }
}
