<?php

namespace App\Controller\Admin;

use App\Entity\Sandwich;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SandwichCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Sandwich::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
