<?php

namespace App\Controller\Admin;

use App\Entity\Student;
use Doctrine\Common\Collections\Collection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StudentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Student::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->setPermissions([
                Action::NEW => 'ROLE_ADMIN',
                Action::DETAIL => 'ROLE_PROFESSOR',
                Action::INDEX => 'ROLE_PROFESSOR',
                Action::EDIT => 'ROLE_ADMIN',
                Action::DELETE => 'ROLE_ADMIN',
            ]);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addColumn(8),
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name'),
            EmailField::new('email'),

            FormField::addColumn(4),
            AssociationField::new('subjects')
                ->setFormTypeOption('by_reference', false)
                ->hideOnDetail(),
            AssociationField::new('subjects')
                ->formatValue(function (Collection $value, Student $entity) {
                    $names = $value->map(fn($subject) => $subject->getName())->toArray();
                    return implode(', ', $names);
                })
                ->onlyOnDetail(),
        ];
    }
}
