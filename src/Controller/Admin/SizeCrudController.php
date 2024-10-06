<?php

namespace App\Controller\Admin;

use App\Entity\Size;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class SizeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Size::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('size', 'Taille')
            ->setCrudController(FlashCrudController::class),
        ];
    }
}
