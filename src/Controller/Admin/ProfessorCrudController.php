<?php

namespace App\Controller\Admin;

use App\Entity\Professor;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ProfessorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Professor::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->setPermissions([
            Action::NEW => 'ROLE_ADMIN',
            Action::DETAIL => 'ROLE_PROFESSOR',
            Action::INDEX => 'ROLE_ADMIN',
            Action::EDIT => 'ROLE_PROFESSOR',
            Action::DELETE => 'ROLE_ADMIN',
        ]);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            EmailField::new('email'),
            Field::new('plainPassword')
                ->setFormType(RepeatedType::class)
                ->setFormTypeOptions([
                    'type' => PasswordType::class,
                    'options' => ['attr' => ['class' => 'password-field']],
                    'required' => true,
                    'first_options' => ['label' => 'Password', 'hash_property_path' => 'password'],
                    'second_options' => ['label' => 'Repeat Password'],
                    'mapped' => false,
                ])->onlyOnForms(),
            ChoiceField::new('roles')
                ->setChoices(['ROLE_USER' => 'ROLE_USER', 'ROLE_ADMIN' => 'ROLE_ADMIN', 'ROLE_PROFESSOR' => 'ROLE_PROFESSOR'])
                ->allowMultipleChoices(),
        ];
    }
}
