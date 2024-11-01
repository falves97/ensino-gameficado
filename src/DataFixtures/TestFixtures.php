<?php

namespace App\DataFixtures;

use App\Factory\AlternativeFactory;
use App\Factory\QuestionFactory;
use App\Factory\TestFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TestFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        TestFactory::createMany(10);

        foreach (TestFactory::all() as $test) {
            QuestionFactory::createMany(5, ['test' => $test]);
        }

        foreach (TestFactory::all() as $test) {
            QuestionFactory::createMany(5, ['test' => $test]);
        }

        foreach (QuestionFactory::all() as $question) {
            AlternativeFactory::createMany(4, ['question' => $question, 'isCorrect' => false]);
            AlternativeFactory::new(['question' => $question, 'isCorrect' => true])->create();
        }
    }
}
