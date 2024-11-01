<?php

namespace App\DataFixtures;

use App\Factory\AlternativeFactory;
use App\Factory\ModuleFactory;
use App\Factory\QuestionFactory;
use App\Factory\SubjectFactory;
use App\Factory\TestFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SubjectFixtures extends Fixture
{
    public function __construct()
    {
    }

    public function load(ObjectManager $manager): void
    {
//        $subjects = ['Math', 'Physics', 'Chemistry', 'Biology', 'History', 'Geography', 'Literature', 'Philosophy', 'Art', 'Music'];
//
//        foreach ($subjects as $subject) {
//            SubjectFactory::createOne(['name' => $subject]);
//        }
    }
}
