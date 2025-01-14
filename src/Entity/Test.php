<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestRepository::class)]
#[ORM\Table(name: 'tests')]
class Test
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'tests')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Module $module = null;

    /**
     * @var Collection<int, Question>
     */
    #[ORM\ManyToMany(targetEntity: Question::class, inversedBy: 'tests')]
    private Collection $questions;

    /**
     * @var Collection<int, StudentTest>
     */
    #[ORM\OneToMany(targetEntity: StudentTest::class, mappedBy: 'test')]
    private Collection $studentTests;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->studentTests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): static
    {
        $this->module = $module;

        return $this;
    }

    /**
     * @return Collection<int, StudentTest>
     */
    public function getStudentTests(): Collection
    {
        return $this->studentTests;
    }

    public function addStudentTest(StudentTest $studentTest): static
    {
        if (!$this->studentTests->contains($studentTest)) {
            $this->studentTests->add($studentTest);
            $studentTest->setTest($this);
        }

        return $this;
    }

    public function removeStudentTest(StudentTest $studentTest): static
    {
        if ($this->studentTests->removeElement($studentTest)) {
            // set the owning side to null (unless already changed)
            if ($studentTest->getTest() === $this) {
                $studentTest->setTest(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): static
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
        }

        return $this;
    }

    public function removeQuestion(Question $question): static
    {
        $this->questions->removeElement($question);

        return $this;
    }

    public function __toString(): string
    {
        return $this->name.' - '.$this->module->getName().' - '.$this->module->getSubject()->getName();
    }
}
