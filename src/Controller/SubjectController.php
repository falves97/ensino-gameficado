<?php

namespace App\Controller;

use App\Entity\Student;
use App\Entity\Subject;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/app/subject')]
class SubjectController extends AbstractController
{
    #[Route('/', name: 'app_subject')]
    public function index(): Response
    {
        return $this->render('subject/index.html.twig', [
            'controller_name' => 'SubjectController',
        ]);
    }

    #[Route('/{id}', name: 'app_subject_enroll')]
    public function enroll(Subject $subject, EntityManagerInterface $entityManager): Response
    {
        /** @var Student $student */
        $student = $this->getUser();
        $subject->addStudent($student);
        $entityManager->flush();

        return $this->redirectToRoute('app_index');
    }
}
