<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    #[Route('/registration', name: 'app_registration')]
    public function index(\Symfony\Component\HttpFoundation\Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $user->setPassword(
                $this->passwordHasher->hashPassword($user, $form->get("password")->getData())
            );

            try {
                $entityManager -> persist($user);
                $entityManager ->flush();
                $this->addFlash("success", message: "Inscription réussie !");
            }catch (UniqueConstraintViolationException){
                echo 'Nom d\'utilisateur ou email déjà utilisé, merci de réessayer.';
            }
        }

        return $this->render('registration/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}