<?php

namespace App\Controller\Admin;

use App\Entity\Sandwich;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
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
            IdField::new('id')->hiedOnForm(),
            TextField::new('name'),
            TextField::new('$sandwichIngredient'),
        ];
    }

}
