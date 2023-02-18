<?php

namespace App\Controller;

use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig');
    }


    #[Route('/account/edit', name: 'app_account_edit')]
    public function editProfile(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $user );

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('message', 'Profil mis à jour');
            return $this->redirectToRoute('account');
        }
        return $this->render('account/editprofile.html.twig');
    }
}
