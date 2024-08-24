<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setName('admin');
        $user->setEmail('admin@admin.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword('$2y$13$y1aV/Y0gSwccH0uIvGTmi.MceW2PRhYJVhsmq2s3gVd0NU54l.49u'); // admin
        $manager->persist($user);
        $manager->flush();
    }
}
