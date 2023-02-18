<?php

namespace App\Controller;

use App\Form\EditProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;



class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig');
    }



    #[Route('/account/edit', name: 'app_account_edit')]
    public function editProfile(EntityManagerInterface $em, Request $request): Response
    {
        //on récupère le user connecté
        $user = $this->getUser();

        //on crée le formulaire
        $editForm = $this->createForm(EditProfileType::class, $user );

        //on traite la requête du form
        $editForm->handleRequest($request);

        if($editForm->isSubmitted() && $editForm->isValid()){
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Votre profil a bien été mis à jour');

            return $this->redirectToRoute('app_account');
        }
        return $this->render('account/editprofile.html.twig', [
            'editForm' => $editForm->createView(),
        ]);
    }

        #[Route('/account/edit/pass', name: 'app_account_edit_pass')]
        public function editPass(EntityManagerInterface $em, Request $request, UserPasswordHasherInterface $passwordHasher): Response
        {


            if($request->isMethod('GET')){

                $user = $this->getUser();

                //on crée le formulaire
                $editPass = $this->createForm(EditProfileType::class, $user );

                //on traite la requête du form
                $editPass->handleRequest($request);

                //on vérifie si les 2 mots de passe sont identiques
                if($request->get('pass') == $request->request->get('pass2')){
                    $user->setPassword($passwordHasher->hashPassword($user, $request->request->get('pass')));
                    $em->flush();
                    $this->addFlash('message', 'Mot de passe à bien été mis à jours avec succès');

                    return $this->redirectToRoute('app_account');
                }else{
                    $this->addFlash('danger', 'les deux mots de passe ne sont pas identiques');
                }
            }
            return $this->render('account/editpass.html.twig');

        }



}
