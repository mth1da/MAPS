<?php

namespace App\Controller\Admin;


use App\Entity\Sandwich;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;


class SandwichCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Sandwich::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->hideOnForm(),
            Field::new('name'),
            AssociationField::new('sandwich_ingredients'),
            Field::new('price'),
            BooleanField::new('isOriginal'),
        ];
    }



}
