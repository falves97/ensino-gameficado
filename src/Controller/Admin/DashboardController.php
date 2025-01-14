<?php

namespace App\Controller\Admin;

use App\Entity\Module;
use App\Entity\Professor;
use App\Entity\Question;
use App\Entity\Student;
use App\Entity\Subject;
use App\Entity\Test;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('@EasyAdmin/page/content.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('App');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Professors', 'fas fa-users', Professor::class)
            ->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Subjects', 'fas fa-book', Subject::class)
            ->setPermission('ROLE_PROFESSOR');
        yield MenuItem::linkToCrud('Students', 'fas fa-user-graduate', Student::class)
            ->setPermission('ROLE_PROFESSOR');
        yield MenuItem::linkToCrud('Modules', 'fas fa-book-open', Module::class)
            ->setPermission('ROLE_PROFESSOR');
        yield MenuItem::linkToCrud('Tests', 'fas fa-tasks', Test::class)
            ->setPermission('ROLE_PROFESSOR');
        yield MenuItem::linkToCrud('Questions', 'fas fa-question', Question::class)
            ->setPermission('ROLE_PROFESSOR');
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->addMenuItems([
                MenuItem::linkToUrl('Profile', 'fa fa-id-card', $this->adminUrlGenerator
                    ->setController(ProfessorCrudController::class)
                    ->setAction(Action::EDIT)
                    ->setEntityId($user->getId())
                    ->generateUrl()
                )->setPermission('ROLE_PROFESSOR'),
            ]);
    }
}
