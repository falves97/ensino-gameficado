<?php

namespace App\DataFixtures;

use App\Entity\Professor;
use App\Entity\Student;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $professor = new Professor();
        $professor->setName('Admin');
        $professor->setEmail('admin@professor.com');
        $professor->setPassword('$2y$13$HnO/3bcCR8PeSRjxbhw5v.tpUF.31NXAa6oruRWoyJH7I7.zHeF16'); // admin
        $professor->setRoles(['ROLE_ADMIN']);
        $manager->persist($professor);

        $professor = new Professor();
        $professor->setName('Professor');
        $professor->setEmail('professor@professor.com');
        $professor->setPassword('$2y$13$HnO/3bcCR8PeSRjxbhw5v.tpUF.31NXAa6oruRWoyJH7I7.zHeF16'); // admin
        $professor->setRoles(['ROLE_PROFESSOR']);
        $manager->persist($professor);

        $student = new Student();
        $student->setName('Student');
        $student->setEmail('student@email.com');
        $student->setPassword('$2y$13$HnO/3bcCR8PeSRjxbhw5v.tpUF.31NXAa6oruRWoyJH7I7.zHeF16'); // admin
        $student->setRoles(['ROLE_STUDENT']);
        $manager->persist($student);

        $manager->flush();
    }
}
