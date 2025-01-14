<?php

namespace App\Controller\Admin;

use App\Entity\Question;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class QuestionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Question::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addColumn(12),
            IdField::new('id')->hideOnForm(),
            AssociationField::new('tests')
                ->hideWhenUpdating(),
            TextEditorField::new('description'),
            CollectionField::new('alternatives')
                ->showEntryLabel()
                ->useEntryCrudForm(AlternativeCrudController::class),
            CollectionField::new('alternatives')
                ->setEntryIsComplex()
                ->useEntryCrudForm(AlternativeCrudController::class)
                ->allowDelete(false)
                ->allowAdd(false)
                ->onlyWhenUpdating(),
        ];
    }
}
