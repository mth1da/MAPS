<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PickRandomSandwichFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pain', CheckboxType::class, [
                'label' => 'Pain',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('viande', CheckboxType::class, [
                'label' => 'Viande',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('poisson', CheckboxType::class, [
                'label' => 'Poisson',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('fromage', CheckboxType::class, [
                'label' => 'Fromage',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('crudites', CheckboxType::class, [
                'label' => 'Crudités',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('plante', CheckboxType::class, [
                'label' => 'Plantes',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('epice', CheckboxType::class, [
                'label' => 'Epice',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('sauce', CheckboxType::class, [
                'label' => 'Sauce',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
