<?php

namespace App\Controller;

use App\Entity\Student;
use App\Repository\SubjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AppController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function home(): Response
    {
        return $this->render('home.html.twig');
    }

    #[Route('/app', name: 'app_index', methods: ['GET'])]
    public function index(SubjectRepository $subjectRepository): Response
    {
        /** @var Student $student */
        $student = $this->getUser();

        $allowedSubjects = $subjectRepository->findAllowedSubjects($student);

        return $this->render('app/index.html.twig', [
            'controller_name' => 'AppController',
            'allowedSubjects' => $allowedSubjects,
        ]);
    }
}
