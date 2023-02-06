<?php

namespace App\Controller\Admin;

use App\Entity\Publication;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PublicationCrudController extends AbstractCrudController
{
    public const Publication_BASE_PATH ='upload/images/publication';
    public const Publication_UPLOAD_DIR ='public/upload/images/publication';
    public static function getEntityFqcn(): string
    {
        return Publication::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),

            ImageField::new('photo')
                ->setBasePath(self::Publication_BASE_PATH)
                ->setUploadDir(self::Publication_UPLOAD_DIR),

            TextEditorField::new('commentaire'),
            DateTimeField::new('created_at')->hideOnForm(),
            TextField::new('$publi_user'),

        ];
    }

}
