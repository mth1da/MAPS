<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user_name', TextType::class, [
                'label' => 'Nom d\'utilisateur : '
            ])
            ->add('first_name', TextType::class, [
                'label' => 'Prénom : '
            ])
            ->add('last_name', TextType::class, [
                'label' => 'Nom de famille : '
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email : '
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe : '
            ])
            ->add('birth_date', BirthdayType::class, [
                'label' => 'Date de naissance : '
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
