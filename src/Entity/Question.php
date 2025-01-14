<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
#[ORM\Table(name: 'questions')]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    /**
     * @var Collection<int, Alternative>
     */
    #[ORM\OneToMany(targetEntity: Alternative::class, mappedBy: 'question', cascade: ['persist'], orphanRemoval: true)]
    private Collection $alternatives;

    /**
     * @var Collection<int, Test>
     */
    #[ORM\ManyToMany(targetEntity: Test::class, mappedBy: 'questions')]
    private Collection $tests;

    public function __construct()
    {
        $this->alternatives = new ArrayCollection();
        $this->tests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Test>
     */
    public function getTests(): Collection
    {
        return $this->tests;
    }

    public function addTest(Test $test): static
    {
        if (!$this->tests->contains($test)) {
            $this->tests->add($test);
            $test->addQuestion($this);
        }

        return $this;
    }

    public function removeTest(Test $test): static
    {
        if ($this->tests->removeElement($test)) {
            $test->removeQuestion($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Alternative>
     */
    public function getAlternatives(): Collection
    {
        return $this->alternatives;
    }

    public function addAlternative(Alternative $alternative): static
    {
        if (!$this->alternatives->contains($alternative)) {
            $this->alternatives->add($alternative);
            $alternative->setQuestion($this);
        }

        return $this;
    }

    public function removeAlternative(Alternative $alternative): static
    {
        if ($this->alternatives->removeElement($alternative)) {
            // set the owning side to null (unless already changed)
            if ($alternative->getQuestion() === $this) {
                $alternative->setQuestion(null);
            }
        }

        return $this;
    }

    public function getCorrectAlternative(): ?Alternative
    {
        foreach ($this->alternatives as $alternative) {
            if ($alternative->isCorrect()) {
                return $alternative;
            }
        }

        return null;
    }

    public function __toString(): string
    {
        return $this->description;
    }
}
