<?php

namespace App\Form;

use App\Entity\Publication;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Image;

class PublicationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('photo', FileType::class, [
                'label' => 'Photo',
                'multiple' => false,
                'mapped' => false, //pas besoin d'etre de meme type que photo dans publication
                'constraints'=>[
                    new All( //permet d'avoir du récursif si on a pls images
                        new Image([
                                'maxWidth'=>1620,
                                'maxWidthMessage'=>'L\'image doit faire {{max_width}} pixels de large au maximum.'
                            ]
                        )
                    )
                ]
            ])
            ->add('commentaire', options:[
                'label' => 'Commentaire'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Publication::class,
        ]);
    }
}
