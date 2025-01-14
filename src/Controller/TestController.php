<?php

namespace App\Controller;

use App\Entity\StudentTest;
use App\Entity\Test;
use App\Form\TestFormType;
use App\Repository\StudentTestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/app/test')]
class TestController extends AbstractController
{
    #[Route('/{id}', name: 'app_test_show', methods: ['GET', 'POST'])]
    public function show(Request $request, Test $test, EntityManagerInterface $em, StudentTestRepository $studentTestRepository): Response
    {
        /**
         * Verificar se o teste ainda não foi respondido pelo aluno
         * Se já foi respondido, redirecionar para a página de resultados.
         */
        $studentTest = $studentTestRepository->findStudentTestByStudentAndTest($this->getUser()->getId(), $test->getId());

        if ($studentTest) {
            return $this->redirectToRoute('app_test_result', ['id' => $studentTest->getId()]);
        }

        $formTest = $this->createForm(TestFormType::class, $test);

        $formTest->handleRequest($request);

        if ($formTest->isSubmitted() && $formTest->isValid()) {
            // ... do your form processing, like saving the Task and Tag entities
            $studentTest = new StudentTest();
            $studentTest->setTest($test);
            $studentTest->setStudent($this->getUser());

            foreach ($test->getQuestions() as $question) {
                $response = $formTest->get("question_{$question->getId()}")->get('alternatives')->getData();
                $studentTest->addResponse($response);

                if ($response->isCorrect()) {
                    $studentTest->setGrade($studentTest->getGrade() + 1);
                }
            }

            $studentTest->setGrade($studentTest->getGrade());

            $em->persist($studentTest);
            $em->flush();

            return $this->redirectToRoute('app_test_result', ['id' => $studentTest->getId()]);
        }

        return $this->render('test/show.html.twig', [
            'test' => $test,
            'formTest' => $formTest,
        ]);
    }

    #[Route('/result/{id}', name: 'app_test_result', methods: ['GET'])]
    public function result(StudentTest $studentTest): Response
    {
        return $this->render('test/result.html.twig', [
            'studentTest' => $studentTest,
        ]);
    }
}
