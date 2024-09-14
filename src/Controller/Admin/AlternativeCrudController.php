<?php

namespace App\Controller\Admin;

use App\Entity\Alternative;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class AlternativeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Alternative::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addColumn(12),
            IdField::new('id')->hideOnForm(),
            BooleanField::new('isCorrect'),
            TextEditorField::new('description'),
        ];
    }
}
