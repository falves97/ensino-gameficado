<?php

namespace App\Controller;

use App\DTO\TestModuleListDTO;
use App\Entity\Module;
use App\Repository\StudentTestRepository;
use App\Repository\TestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/app/module')]
class ModuleController extends AbstractController
{
    #[Route('/{id}', name: 'app_module_show', methods: ['GET'])]
    public function show(Module $module, StudentTestRepository $studentTestRepository, TestRepository $testRepository): Response
    {
        $studentTests = $studentTestRepository->findByStudentAndModule($this->getUser()->getId(), $module->getId());
        $studentTestsDTO = array_map(function ($studentTest) {
            return new TestModuleListDTO(
                $studentTest->getTest()->getId(),
                $studentTest->getTest()->getName(),
                $studentTest->getGrade(),
                true
            );
        }, $studentTests);

        $notAnsweredTests = $testRepository->findNotAnsweredTestsByStudentAndModule($module->getId());
        $notAnsweredTestsDTO = array_map(function ($test) {
            return new TestModuleListDTO(
                $test->getId(),
                $test->getName(),
                0,
                false
            );
        }, $notAnsweredTests);

        $tests = array_merge($studentTestsDTO, $notAnsweredTestsDTO);

        return $this->render('module/show.html.twig', [
            'module' => $module,
            'tests' => $tests,
        ]);
    }
}
