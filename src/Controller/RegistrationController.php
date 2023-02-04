<?php

namespace App\Controller;

use App\Services\RegistrationFormHandler;
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
    private EntityManagerInterface $entityManager;
    private RegistrationFormType $registrationForm;

    public function __construct(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager, RegistrationFormType $registrationForm)
    {
        $this->passwordHasher = $passwordHasher;
        $this->entityManager = $entityManager;
        $this->registrationForm = $registrationForm;
    }

    #[Route('/registration', name: 'app_registration')]
    public function index(\Symfony\Component\HttpFoundation\Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->registrationForm->handleform($user, $form);
        }

        return $this->render('registration/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}