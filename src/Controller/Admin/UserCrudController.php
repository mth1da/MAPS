<?php

namespace App\Controller\Admin;

use App\Entity\Ingredient;
use App\Entity\User;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
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
            IdField::new('id'),
            TextField::new('email'),
            TextEditorField::new('roles'),
            TextField::new('password'),
            TextField::new('first_name'),
            TextField::new('last_name'),
            TextField::new('user_name'),
            TextField::new('birth_date'),
            TextField::new('created_at'),
            TextField::new('user_order'),
            TextField::new('publications'),
            TextField::new('user_resa'),
            TextField::new('user_bookmarks'),
        ];
    }

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if(!$entityInstance instanceof User) return;

        $entityInstance->setCreatedAt(new \DateTimeImmutable);


        parent::persistEntity($em, $entityInstance);

    }

}
