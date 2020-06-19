<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NotebookTaskRepository")
 */
class NotebookTask
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datetime_start;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datetime_end;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Subject", inversedBy="notebookTasks")
     */
    private $subject;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="notebookTasks")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=NotebookGoal::class, mappedBy="task", orphanRemoval=true)
     */
    private $goals;

    /**
     * @ORM\OneToMany(targetEntity=NotebookSkill::class, mappedBy="task", orphanRemoval=true)
     */
    private $skills;

    /**
     * @ORM\OneToMany(targetEntity=NotebookMaterial::class, mappedBy="task", orphanRemoval=true)
     */
    private $materials;

    public function __construct()
    {
        $this->goals = new ArrayCollection();
        $this->skills = new ArrayCollection();
        $this->materials = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatetimeStart(): ?\DateTimeInterface
    {
        return $this->datetime_start;
    }

    public function setDatetimeStart(\DateTimeInterface $datetime_start): self
    {
        $this->datetime_start = $datetime_start;

        return $this;
    }

    public function getDatetimeEnd(): ?\DateTimeInterface
    {
        return $this->datetime_end;
    }

    public function setDatetimeEnd(\DateTimeInterface $datetime_end): self
    {
        $this->datetime_end = $datetime_end;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    public function setSubject(?Subject $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|NotebookGoal[]
     */
    public function getGoals(): Collection
    {
        return $this->goals;
    }

    public function addGoal(NotebookGoal $goal): self
    {
        if (!$this->goals->contains($goal)) {
            $this->goals[] = $goal;
            $goal->setTask($this);
        }

        return $this;
    }

    public function removeGoal(NotebookGoal $goal): self
    {
        if ($this->goals->contains($goal)) {
            $this->goals->removeElement($goal);
            // set the owning side to null (unless already changed)
            if ($goal->getTask() === $this) {
                $goal->setTask(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|NotebookSkill[]
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(NotebookSkill $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
            $skill->setTask($this);
        }

        return $this;
    }

    public function removeSkill(NotebookSkill $skill): self
    {
        if ($this->skills->contains($skill)) {
            $this->skills->removeElement($skill);
            // set the owning side to null (unless already changed)
            if ($skill->getTask() === $this) {
                $skill->setTask(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|NotebookMaterial[]
     */
    public function getMaterials(): Collection
    {
        return $this->materials;
    }

    public function addMaterial(NotebookMaterial $material): self
    {
        if (!$this->materials->contains($material)) {
            $this->materials[] = $material;
            $material->setTask($this);
        }

        return $this;
    }

    public function removeMaterial(NotebookMaterial $material): self
    {
        if ($this->materials->contains($material)) {
            $this->materials->removeElement($material);
            // set the owning side to null (unless already changed)
            if ($material->getTask() === $this) {
                $material->setTask(null);
            }
        }

        return $this;
    }
}
