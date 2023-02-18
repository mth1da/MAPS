<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Constraints\Length;

class RegistrationFormType extends AbstractType
{
    private UserPasswordHasherInterface $passwordHasher;
    private EntityManagerInterface $entityManager;

    public function __construct(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager)
    {
        $this->passwordHasher = $passwordHasher;
        $this->entityManager = $entityManager;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user_name', TextType::class, [
                'label' => 'Nom d\'utilisateur',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('first_name', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('last_name', TextType::class, [
                'label' => 'Nom de famille',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'attr' => [
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new Length([
                        'min'=>6,
                        'minMessage'=> 'Your password should at least be of 6 characters',
                        //max length allowed by symf for security reasons
                        'max'=>4096,
                    ])
                ]
            ])
            ->add('birth_date', BirthdayType::class, [
                'label' => 'Date de naissance',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

    public function handleForm(User $user, \Symfony\Component\Form\FormInterface $form): void
    {
        $user->setPassword(
            $this->passwordHasher->hashPassword($user, $form->get("password")->getData())
        );

        try {
            $this->entityManager -> persist($user);
            $this->entityManager ->flush();
            echo "Inscription réussie !";

        }catch (UniqueConstraintViolationException){
            echo 'Nom d\'utilisateur ou email déjà utilisé, merci de réessayer.';
        }


            //$this->addFlash('reussite', 'Inscription réussie !');
            //$this->addFlash('echec', 'Nom d\'utilisateur ou email déjà utilisé, merci de réessayer.');


    }
}
