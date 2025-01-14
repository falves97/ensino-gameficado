<?php

namespace App\Entity;

use App\Repository\StudentTestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentTestRepository::class)]
#[ORM\Table(name: 'students_tests')]
class StudentTest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Student $student = null;

    #[ORM\ManyToOne(inversedBy: 'studentTests')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Test $test = null;

    #[ORM\Column]
    private ?int $grade = null;

    /**
     * @var Collection<int, Alternative>
     */
    #[ORM\ManyToMany(targetEntity: Alternative::class)]
    #[ORM\JoinTable(name: 'students_tests_alternatives')]
    private Collection $responses;

    public function __construct()
    {
        $this->responses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): static
    {
        $this->student = $student;

        return $this;
    }

    public function getTest(): ?Test
    {
        return $this->test;
    }

    public function setTest(?Test $test): static
    {
        $this->test = $test;

        return $this;
    }

    public function getGrade(): int
    {
        return $this->grade ?: 0;
    }

    public function setGrade(int $grade): static
    {
        $this->grade = max($grade, 0);

        return $this;
    }

    /**
     * @return Collection<int, Alternative>
     */
    public function getResponses(): Collection
    {
        return $this->responses;
    }

    public function addResponse(Alternative $response): static
    {
        if (!$this->responses->contains($response)) {
            $this->responses->add($response);
        }

        return $this;
    }

    public function removeResponse(Alternative $response): static
    {
        $this->responses->removeElement($response);

        return $this;
    }
}
