<?php

namespace App\Controller\Admin;

use App\Entity\Flash;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use Vich\UploaderBundle\Form\Type\VichFileType;

class FlashCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Flash::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TimeField::new('realisationTime', 'Temps'),
            MoneyField::new('price', 'prix')->setCurrency('EUR')->setStoredAsCents(),
            BooleanField::new('Available'),
            AssociationField::new('size', 'Taille'),
            TextareaField::new('posterFile')->setFormType(VichFileType::class),
        ];
    }
}
