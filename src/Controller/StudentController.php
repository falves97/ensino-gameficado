<?php

namespace App\Controller;

use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/student')]
class StudentController extends AbstractController
{
    #[Route('/create', name: 'app_student_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager, Security $security, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $student = new Student();

        $createForm = $this->createFormBuilder($student, ['action' => $this->generateUrl('app_student_create')])
            ->add('name', TextType::class, ['label' => 'Nome'])
            ->add('email', EmailType::class, ['label' => 'E-mail'])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Senha'],
                'second_options' => ['label' => 'Repita a senha'],
            ])
            ->getForm();

        $createForm->handleRequest($request);
        if ($createForm->isSubmitted() && $createForm->isValid()) {
            $student = $createForm->getData();
            $student->setPassword($userPasswordHasher->hashPassword($student, $student->getPlainPassword()));
            $student->eraseCredentials();

            $entityManager->persist($student);
            $entityManager->flush();

            // Loga o estudante automaticamente
            $security->login($student, firewallName: 'main');

            return $this->redirectToRoute('app_index');
        }

        return $this->render('student/create.html.twig', [
            'createForm' => $createForm,
        ]);
    }
}
