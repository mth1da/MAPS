<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityServices
{

    public function resetPassword(User $user, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher, FormInterface $form): void{
        $user->setResetToken('');
        $user->setPassword(
            $passwordHasher->hashPassword($user, $form->get('password')->getData())
        );
        $entityManager->persist($user);
        $entityManager->flush();
    }
}