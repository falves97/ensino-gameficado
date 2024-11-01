<?php

namespace App\DataFixtures;

use App\Entity\Professor;
use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $professor = new Professor();
        $professor->setName('Admin');
        $professor->setEmail('admin@professor.com');
        $professor->setPassword($this->hasher->hashPassword($professor, 'admin'));
        $professor->setRoles(['ROLE_ADMIN']);
        $manager->persist($professor);

        $professor = new Professor();
        $professor->setName('Professor');
        $professor->setEmail('professor@professor.com');
        $professor->setPassword($this->hasher->hashPassword($professor, 'professor'));
        $professor->setRoles(['ROLE_PROFESSOR']);
        $manager->persist($professor);

        $student = new Student();
        $student->setName('Student');
        $student->setEmail('student@email.com');
        $student->setPassword($this->hasher->hashPassword($student, 'student'));
        $student->setRoles(['ROLE_STUDENT']);
        $manager->persist($student);

        $manager->flush();
    }
}
