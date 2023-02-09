<?php

namespace App\Controller\Admin;

use App\Entity\Ingredient;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('email'),
            ChoiceField::new('roles')->setChoices([
                'ROLE_ADMIN' => 'ROLE_ADMIN',
                // le dernier role de cette liste seras selectionner par default
                'ROLE_USER' => 'ROLE_USER',
            ])
                ->allowMultipleChoices(),
            TextField::new('password'),
            TextField::new('first_name'),
            TextField::new('last_name'),
            TextField::new('user_name'),
            DateTimeField::new('birth_date'),
            DateTimeField::new('created_at')->hideOnForm(),
            //AssociationField::new('user_bookmarks'),

        ];
    }
/*    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if(!$entityInstance instanceof Ingredient) return;

        $entityInstance->setCreatedAt(new \DateTimeImmutable);


        parent::persistEntity($em, $entityInstance);

    }*/

}
