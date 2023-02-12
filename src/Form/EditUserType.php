<?php

namespace App\Form;

use App\Entity\User;
use PharIo\Manifest\Email;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', Email::class, [
                'constraints'=>[
                    new NotBlank([
                    'message'=>'Merci de saisir une adresse email'
                ])
                ],
               'required' =>true,
                'attr'=>[
                    'class' => 'form-control'
                ]
            ])
            ->add('roles', ChoiceType ::class, [
                'choices'=>[
                    'Utilisateur'=>'ROLE_USER',
                    'Editeur'=>'ROLE_RDITOR',
                    'Modérateur'=>'ROLE_MODO',
                    'Administrateur'=>'ROLE_ADMIN'
                ],
                'expanded'=>true,
                'multiple'=>true,
                'label'=>'Roles'
            ])
            ->add('Valider', SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
