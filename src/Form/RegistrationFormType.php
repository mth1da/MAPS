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
                ],
                'constraints' => [
                    new Length([
                        'min'=>4,
                        'minMessage'=> 'Le nom d\'utilisateur doit faire au moins 4 caractères',
                        //max length allowed by symf for security reasons
                        'max'=>4096,
                    ])
                ]
            ])
            ->add('first_name', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new Length([
                        'min'=>2,
                        'minMessage'=> 'Le prénom doit faire au moins 2 caractères',
                        //max length allowed by symf for security reasons
                        'max'=>4096,
                    ])
                ]
            ])
            ->add('last_name', TextType::class, [
                'label' => 'Nom de famille',
                'attr' => [
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new Length([
                        'min'=>2,
                        'minMessage'=> 'Le nom de famille doit faire au moins 2 caractères',
                        //max length allowed by symf for security reasons
                        'max'=>4096,
                    ])
                ]
            ])
            ->add('birth_date', BirthdayType::class, [
                'label' => 'Date de naissance',
                'placeholder' => [
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                ],
                'format' => 'dd-MM-yyyy',
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
                        'minMessage'=> 'Le mot de passe doit faire au moins 6 caractères',
                        //max length allowed by symf for security reasons
                        'max'=>4096,
                    ])
                ]
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
            //echo "Inscription réussie !";

        }catch (UniqueConstraintViolationException){
            //echo 'Nom d\'utilisateur ou email déjà utilisé, merci de réessayer.';
        }

    }
}
