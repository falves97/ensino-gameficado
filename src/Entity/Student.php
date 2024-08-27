<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
#[ORM\Table(name: 'students')]
class Student extends User
{
    public function __construct()
    {
        $this->setRoles(['ROLE_STUDENT']);
    }
}
