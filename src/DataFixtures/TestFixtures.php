<?php

namespace App\DataFixtures;

use App\Factory\AlternativeFactory;
use App\Factory\ModuleFactory;
use App\Factory\ProfessorFactory;
use App\Factory\QuestionFactory;
use App\Factory\StudentFactory;
use App\Factory\SubjectFactory;
use App\Factory\TestFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TestFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Student and Admin
        $admin = ProfessorFactory::new()->create(['email' => 'admin@email.com', 'password' => 'password', 'roles' => ['ROLE_ADMIN']]);
        $student = StudentFactory::new()->create(['email' => 'student@email.com', 'password' => 'password']);
        $professor = ProfessorFactory::new()->create(['email' => 'professor@email.com', 'password' => 'password']);

        $subject = SubjectFactory::new()->create(['name' => 'Math', 'professor' => $professor]);

        $module = ModuleFactory::new()->create(['name' => 'Module 1', 'subject' => $subject]);
        $test = TestFactory::new()->create(['name' => 'Test 1', 'module' => $module]);
        $questions = QuestionFactory::new()->createMany(5, ['tests' => [$test]]);
        foreach ($questions as $question) {
            AlternativeFactory::new()->createMany(4, ['question' => $question, 'isCorrect' => false]);
            AlternativeFactory::new()->create(['question' => $question, 'isCorrect' => true]);
        }
    }
}
