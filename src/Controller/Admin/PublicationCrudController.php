<?php

namespace App\Controller\Admin;

use App\Entity\Publication;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class PublicationCrudController extends AbstractCrudController
{
    public const PUBLICATION_BASE_PATH ='upload/images/publications';
    public const PUBLICATION_UPLOAD_DIR ='public/upload/images/publications';
    public static function getEntityFqcn(): string
    {
        return Publication::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),

            ImageField::new('photo')
                ->setBasePath(self::PUBLICATION_BASE_PATH)
                ->setUploadDir(self::PUBLICATION_UPLOAD_DIR),

            TextEditorField::new('commentaire'),
            AssociationField::new('publi_user'),
            DateTimeField::new('created_at')->hideOnForm(),
            DateTimeField::new('updated_at')->hideOnForm(),

        ];
    }

    public function updateEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if(!$entityInstance instanceof Publication) return;

        $entityInstance->setUpdatedAt(new \DateTimeImmutable);

        parent::UpdateEntity($em, $entityInstance);
    }

}
