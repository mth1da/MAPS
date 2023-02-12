<?php

namespace App\Controller\Admin;

use App\Entity\Ingredient;
use App\Entity\Sandwich;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

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
            //Field::new('sandwich_ingredients'),
        ];
    }



}
