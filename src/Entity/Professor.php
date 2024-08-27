<?php

namespace App\Entity;

use App\Repository\ProfessorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfessorRepository::class)]
#[ORM\Table(name: 'professors')]
class Professor extends User
{
    public function __construct()
    {
        $this->setRoles(['ROLE_PROFESSOR']);
    }
}
