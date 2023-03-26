<?php

namespace App\Form;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class PickRandomSandwichFormType extends AbstractType implements EventSubscriberInterface
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
            ])
            ->add('nom', TextType::class, [
                'label' => 'Choisis un nom pour ton sandwich !',
                'attr' => [
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new Length([
                        'min'=>4,
                        'minMessage'=> 'Le nom du sandwich doit faire au moins 4 caractères',
                        //max length allowed by symf for security reasons
                        'max'=>4096,
                    ])
                ]
            ]);

        // telling the form builder about the new event subscriber
        $builder->addEventSubscriber($this);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }

    public static function getSubscribedEvents()
    {
        return [
            FormEvents::SUBMIT => 'ensureOneFieldIsSubmitted',
        ];
    }

    public function ensureOneFieldIsSubmitted(FormEvent $event)
    {
        $submittedData = $event->getData();

        // just checking for `null` here
        if (!isset($submittedData['pain']) && !isset($submittedData['viande'])) {
            throw new TransformationFailedException(
                'choisir au moins un checkbox',
                0, // code
                null, // previous
                'choisissez au moins un type d\'ingrédient', // user message
                ['{{ whatever }}' => 'here'] // message context for the translater
            );
        }
    }
}
