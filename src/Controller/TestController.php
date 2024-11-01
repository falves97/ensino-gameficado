<?php

namespace App\Controller;

use App\Entity\Test;
use App\Form\TestFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/app/test')]
class TestController extends AbstractController
{
    #[Route('/{id}', name: 'app_test_show')]
    public function show(Test $test): Response
    {
        $formTest = $this->createForm(TestFormType::class, $test);

        return $this->render('test/show.html.twig', [
            'test' => $test,
            'formTest' => $formTest,
        ]);
    }
}
